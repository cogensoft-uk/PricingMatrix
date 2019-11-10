<?php
namespace Cogensoft\PricingMatrix\Model;

use Magento\Framework\DB\Adapter\ConnectionException;
use Magento\Framework\DB\Adapter\DeadlockException;
use Magento\Framework\DB\Adapter\LockWaitException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\TemporaryState\CouldNotSaveException as TemporaryCouldNotSaveException;
use Cogensoft\PricingMatrix\Model\AdvancedPriceListFactory;
use Cogensoft\PricingMatrix\Model\ResourceModel\AdvancedPriceList AS ResourceModel;
use Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListUpdateInterface AS AdvancedPriceListUpdate;
use Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListInterface AS AdvancedPriceList;

class AdvancedPriceListRepository implements \Cogensoft\PricingMatrix\Api\AdvancedPriceListInterface
{
	/**
	 * @var \Cogensoft\PricingMatrix\Model\AdvancedPriceListFactory
	 */
	protected $advancedPriceListFactory;

	/**
	 * @var \Cogensoft\PricingMatrix\Model\ResourceModel\AdvancedPriceList
	 */
	protected $resourceModel;

	public function __construct(
		AdvancedPriceListFactory $advancedPriceListFactory,
		ResourceModel $resourceModel
	) {
		$this->advancedPriceListFactory = $advancedPriceListFactory;
		$this->resourceModel = $resourceModel;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createPriceListAdvanced($advancedPriceLists)
	{
		if(!is_array($advancedPriceLists)) throw new \Magento\Framework\Exception\InputException('Invalid input data');
		if( count($advancedPriceLists) === count($advancedPriceLists, COUNT_RECURSIVE)) {
			//Single entity passed, covert to multi-dimensional
			$advancedPriceLists = [$advancedPriceLists];
		}

		foreach($advancedPriceLists AS $advancedPriceListData) {
			$advancedPriceList = $this->initializeAdvancedPriceList($advancedPriceListData);
			$this->resourceModel->validateCreate($advancedPriceList);
			try {
				$model = $this->getPriceListAdvancedByPrimary($advancedPriceList->getPrimary());
			} catch (NoSuchEntityException $e) {
				$model = null;
			}

			if(!$this->saveAdvancedPriceList($model, $advancedPriceList)) throw new LocalizedException('Unable to create the entry');
		}

		return $advancedPriceLists;
	}

    /**
     * {@inheritdoc}
     */
    public function getPriceListAdvancedByPrimary($primary)
    {
	    $advancedPriceListId = $this->resourceModel->getIdByPrimary($primary);
	    if(!$advancedPriceListId) throw NoSuchEntityException::singleField('primary', $primary);

	    return $this->advancedPriceListFactory->create()->load($advancedPriceListId);
    }

	/**
	 * {@inheritdoc}
	 */
	public function updatePriceListAdvancedByPrimary($primary, AdvancedPriceListUpdate $advancedPriceList)
	{
		$this->resourceModel->validateUpdate($advancedPriceList);
		$model = $this->getPriceListAdvancedByPrimary($primary);
		if(!$this->saveAdvancedPriceList($model, $advancedPriceList)) throw new LocalizedException('Unable to update the entry');

		return $advancedPriceList;
	}

	/**
	 * @inheritdoc
	 */
	public function delete(AdvancedPriceList $advancedPriceList)
	{
		try {
			$this->resourceModel->delete($advancedPriceList);
		} catch (\Exception $e) {
			throw new \Magento\Framework\Exception\LocalizedException (
				__('Unable to remove entry: '.$e->getMessage())
			);
		}

		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function deletePriceListAdvancedByPrimary($primary)
	{
		$customerPriceList = $this->getPriceListAdvancedByPrimary($primary);

		return $this->delete($customerPriceList);
	}

	/**
	 * Save resource model.
	 *
	 * @param mixed $advancedPriceList
	 * @return ResourceModel $advancedPriceList
	 * @throws TemporaryCouldNotSaveException
	 * @throws InputException
	 * @throws CouldNotSaveException
	 * @throws LocalizedException
	 */
	protected function saveAdvancedPriceList($model, $advancedPriceList)
	{
		$dataArray = $advancedPriceList->getRawData();

		try {
			$model = $this->initializeAdvancedPriceList($dataArray, $model);
			return $this->resourceModel->save($model);
		} catch (ConnectionException $exception) {
			throw new TemporaryCouldNotSaveException(
				__('Database connection error'),
				$exception,
				$exception->getCode()
			);
		} catch (DeadlockException $exception) {
			throw new TemporaryCouldNotSaveException(
				__('Database deadlock found when trying to get lock'),
				$exception,
				$exception->getCode()
			);
		} catch (LockWaitException $exception) {
			throw new TemporaryCouldNotSaveException(
				__('Database lock wait timeout exceeded'),
				$exception,
				$exception->getCode()
			);
		} catch(NoSuchEntityException $exception) {
			throw new \Magento\Framework\Exception\LocalizedException (
				__('Unable to locate entry to update: '.$exception->getMessage())
			);
		} catch (LocalizedException $exception) {
			throw $exception;
		} catch (\Exception $exception) {
			throw new CouldNotSaveException(__('Unable to save entry: '.$exception->getMessage()), $exception);
		}
	}

	/**
	 * initializeAdvancedPriceList
	 *
	 * @param array $data
	 * @param mixed $advancedPriceList
	 *
	 * @return mixed
	 */
	protected function initializeAdvancedPriceList(array $data, $advancedPriceList = null) {
		if (!$advancedPriceList) {
			$advancedPriceList = $this->advancedPriceListFactory->create();
		}

		foreach ($data as $key => $value) {
			$advancedPriceList->setRawData($key, $value);
		}

		return $advancedPriceList;
	}
}
