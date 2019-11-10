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
use Cogensoft\PricingMatrix\Model\DetailPriceListFactory;
use Cogensoft\PricingMatrix\Model\ResourceModel\DetailPriceList AS ResourceModel;
use Cogensoft\PricingMatrix\Api\Data\DetailPriceListUpdateInterface AS DetailPriceListUpdate;
use Cogensoft\PricingMatrix\Api\Data\DetailPriceListInterface AS DetailPriceList;

class DetailPriceListRepository implements \Cogensoft\PricingMatrix\Api\DetailPriceListInterface
{
	/**
	 * @var \Cogensoft\PricingMatrix\Model\DetailPriceListFactory
	 */
	protected $detailPriceListFactory;

	/**
	 * @var \Cogensoft\PricingMatrix\Model\ResourceModel\DetailPriceList
	 */
	protected $resourceModel;

	public function __construct(
		DetailPriceListFactory $detailPriceListFactory,
		ResourceModel $resourceModel
	) {
		$this->detailPriceListFactory = $detailPriceListFactory;
		$this->resourceModel = $resourceModel;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createPriceListDetail($detailPriceLists)
	{
		if(!is_array($detailPriceLists)) throw new \Magento\Framework\Exception\InputException('Invalid input data');
		if( count($detailPriceLists) === count($detailPriceLists, COUNT_RECURSIVE)) {
			//Single entity passed, covert to multi-dimensional
			$detailPriceLists = [$detailPriceLists];
		}

		foreach($detailPriceLists AS $detailPriceListData) {
			$detailPriceList = $this->initializeDetailPriceList($detailPriceListData);
			$this->resourceModel->validateCreate($detailPriceList);
			try {
				$model = $this->getPriceListDetailByPrimary($detailPriceList->getPrimary());
			} catch (NoSuchEntityException $e) {
				$model = null;
			}

			if(!$this->saveDetailPriceList($model, $detailPriceList)) throw new LocalizedException('Unable to create the entry');
		}

		return $detailPriceLists;
	}

    /**
     * {@inheritdoc}
     */
    public function getPriceListDetailByPrimary($primary)
    {
	    $detailPriceListId = $this->resourceModel->getIdByPrimary($primary);
	    if(!$detailPriceListId) throw NoSuchEntityException::singleField('primary', $primary);

	    return $this->detailPriceListFactory->create()->load($detailPriceListId);
    }

	/**
	 * {@inheritdoc}
	 */
	public function updatePriceListDetailByPrimary($primary, DetailPriceListUpdate $detailPriceList)
	{
		$this->resourceModel->validateUpdate($detailPriceList);
		$model = $this->getPriceListDetailByPrimary($primary);
		if(!$this->saveDetailPriceList($model, $detailPriceList)) throw new LocalizedException('Unable to update the entry');

		return $detailPriceList;
	}

	/**
	 * @inheritdoc
	 */
	public function delete(DetailPriceList $detailPriceList)
	{
		try {
			$this->resourceModel->delete($detailPriceList);
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
	public function deletePriceListDetailByPrimary($primary)
	{
		$customerPriceList = $this->getPriceListDetailByPrimary($primary);

		return $this->delete($customerPriceList);
	}

	/**
	 * Save resource model.
	 *
	 * @param mixed $customerPriceList
	 * @return ResourceModel $detailPriceList
	 * @throws TemporaryCouldNotSaveException
	 * @throws InputException
	 * @throws CouldNotSaveException
	 * @throws LocalizedException
	 */
	protected function saveDetailPriceList($model, $detailPriceList)
	{
		$dataArray = $detailPriceList->getRawData();

		try {
			$model = $this->initializeDetailPriceList($dataArray, $model);
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
	 * initializeDetailPriceList
	 *
	 * @param array $data
	 * @param mixed $detailPriceList
	 *
	 * @return mixed
	 */
	protected function initializeDetailPriceList(array $data, $detailPriceList = null) {
		if (!$detailPriceList) {
			$detailPriceList = $this->detailPriceListFactory->create();
		}

		foreach ($data as $key => $value) {
			$detailPriceList->setRawData($key, $value);
		}

		return $detailPriceList;
	}
}
