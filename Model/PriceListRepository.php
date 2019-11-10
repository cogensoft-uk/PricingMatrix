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
use Cogensoft\PricingMatrix\Model\PriceListFactory;
use Cogensoft\PricingMatrix\Model\ResourceModel\PriceList AS ResourceModel;
use Cogensoft\PricingMatrix\Api\Data\PriceListUpdateInterface AS PriceListUpdate;
use Cogensoft\PricingMatrix\Api\Data\PriceListInterface AS PriceList;


class PriceListRepository implements \Cogensoft\PricingMatrix\Api\PriceListInterface
{
	/**
	 * @var \Cogensoft\PricingMatrix\Model\PriceListFactory
	 */
	protected $priceListFactory;

	/**
	 * @var \Cogensoft\PricingMatrix\Model\ResourceModel\PriceList
	 */
	protected $resourceModel;

	public function __construct(
		PriceListFactory $priceListFactory,
		ResourceModel $resourceModel
	) {
		$this->priceListFactory = $priceListFactory;
		$this->resourceModel = $resourceModel;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createPriceList($priceLists)
	{
		if(!is_array($priceLists)) throw new \Magento\Framework\Exception\InputException('Invalid input data');
		if( count($priceLists) === count($priceLists, COUNT_RECURSIVE)) {
			//Single entity passed, covert to multi-dimensional
			$priceLists = [$priceLists];
		}

		foreach($priceLists AS $priceListData) {
			$priceList = $this->initializePriceList($priceListData);
			$this->resourceModel->validateCreate($priceList);
			try {
				$model = $this->getPriceListByPrimary($priceList->getPrimary());
			} catch (NoSuchEntityException $e) {
				$model = null;
			}

			if(!$this->savePriceList($model, $priceList)) throw new LocalizedException('Unable to create the entry');
		}

		return $priceLists;
	}

    /**
     * {@inheritdoc}
     */
    public function getPriceListByPrimary($primary)
    {
	    $priceListId = $this->resourceModel->getIdByPrimary($primary);
	    if(!$priceListId) throw NoSuchEntityException::singleField('primary', $primary);

	    return $this->priceListFactory->create()->load($priceListId);
    }

	/**
	 * {@inheritdoc}
	 */
	public function updatePriceListByPrimary($primary, PriceListUpdate $priceList)
	{
		$this->resourceModel->validateUpdate($priceList);
		$model = $this->getPriceListByPrimary($primary);
		if(!$this->savePriceList($model, $priceList)) throw new LocalizedException('Unable to update the entry');

		return $priceList;
	}

	/**
	 * @inheritdoc
	 */
	public function delete(PriceList $priceList)
	{
		try {
			$this->resourceModel->delete($priceList);
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
	public function deletePriceListByPrimary($primary)
	{
		$customerPriceList = $this->getPriceListByPrimary($primary);

		return $this->delete($customerPriceList);
	}

	/**
	 * Save resource model.
	 *
	 * @param mixed $priceList
	 *
	 * @return ResourceModel $priceList
	 * @throws TemporaryCouldNotSaveException
	 * @throws InputException
	 * @throws CouldNotSaveException
	 * @throws LocalizedException
	 */
	protected function savePriceList($model, $priceList)
	{
		$dataArray = $priceList->getRawData();

		try {
			$model = $this->initializePriceList($dataArray, $model);
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
	 * initializePriceList
	 *
	 * @param array $data
	 * @param mixed $priceList
	 *
	 * @return mixed
	 */
	protected function initializePriceList(array $data, $priceList = null) {
		if (!$priceList) {
			$priceList = $this->priceListFactory->create();
		}

		foreach ($data as $key => $value) {
			$priceList->setRawData($key, $value);
		}

		return $priceList;
	}
}
