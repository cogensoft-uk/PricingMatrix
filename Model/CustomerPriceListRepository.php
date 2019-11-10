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
use Cogensoft\PricingMatrix\Model\ResourceModel\CustomerPriceList AS ResourceModel;
use Cogensoft\PricingMatrix\Api\Data\CustomerPriceListUpdateInterface as CustomerPriceListUpdate;
use Cogensoft\PricingMatrix\Api\Data\CustomerPriceListInterface as CustomerPriceList;

class CustomerPriceListRepository implements \Cogensoft\PricingMatrix\Api\CustomerPriceListInterface
{
	/**
	 * @var \Cogensoft\PricingMatrix\Model\CustomerPriceListFactory
	 */
	protected $customerPriceListFactory;

	/**
	 * @var \Cogensoft\PricingMatrix\Model\ResourceModel\CustomerPriceList
	 */
	protected $resourceModel;

	public function __construct(
		CustomerPriceListFactory $customerPriceListFactory,
		ResourceModel $resourceModel
	) {
		$this->customerPriceListFactory = $customerPriceListFactory;
		$this->resourceModel = $resourceModel;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createCustomerPriceList($customerPriceLists)
	{
		if(!is_array($customerPriceLists)) throw new \Magento\Framework\Exception\InputException('Invalid input data');
		if( count($customerPriceLists) === count($customerPriceLists, COUNT_RECURSIVE)) {
			 //Single entity passed, covert to multi-dimensional
			$customerPriceLists = [$customerPriceLists];
		}

		foreach($customerPriceLists AS $customerPriceListData) {
			$customerPriceList = $this->initializeCustomerPriceList($customerPriceListData);
			$this->resourceModel->validateCreate($customerPriceList);
			try {
				$model = $this->getCustomerPriceListByPrimary($customerPriceList->getPrimary());
			} catch (NoSuchEntityException $e) {
				$model = null;
			}

			if(!$this->saveCustomerPriceList($model, $customerPriceList)) throw new LocalizedException('Unable to create the entry');
		}

		return $customerPriceLists;
	}

    /**
     * {@inheritdoc}
     */
    public function getCustomerPriceListByPrimary($primary)
    {
    	$customerPriceListId = $this->resourceModel->getIdByPrimary($primary);
	    if(!$customerPriceListId) throw NoSuchEntityException::singleField('primary', $primary);

	    return $this->customerPriceListFactory->create()->load($customerPriceListId);
    }

	/**
	 * {@inheritdoc}
	 */
	public function updateCustomerPriceListByPrimary($primary, CustomerPriceListUpdate $customerPriceList)
	{
		$this->resourceModel->validateUpdate($customerPriceList);
		$model = $this->getCustomerPriceListByPrimary($primary);
		if(!$this->saveCustomerPriceList($model, $customerPriceList)) throw new LocalizedException('Unable to update the entry');

		return $customerPriceList;
	}

	/**
	 * @inheritdoc
	 */
	public function delete(CustomerPriceList $customerPriceList)
	{
		try {
			$this->resourceModel->delete($customerPriceList);
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
	public function deleteCustomerPriceListByPrimary($primary)
	{
		$customerPriceList = $this->getCustomerPriceListByPrimary($primary);

		return $this->delete($customerPriceList);
	}

	/**
	 * Save resource model.
	 *
	 * @param mixed $customerPriceList
	 * @return ResourceModel $customerPriceList
	 * @throws TemporaryCouldNotSaveException
	 * @throws InputException
	 * @throws CouldNotSaveException
	 * @throws LocalizedException
	 */
	protected function saveCustomerPriceList($model, $customerPriceList)
	{
		$dataArray = $customerPriceList->getRawData();

		try {
			$model = $this->initializeCustomerPriceList($dataArray, $model);
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
	 * initializeCustomerPriceList
	 *
	 * @param array $data
	 * @param mixed $customerPriceList
	 *
	 * @return \Cogensoft\PricingMatrix\Model\CustomerPriceList
	 */
	protected function initializeCustomerPriceList(array $data, $customerPriceList = null) {
		if (!$customerPriceList) {
			$customerPriceList = $this->customerPriceListFactory->create();
		}

		foreach ($data as $key => $value) {
			$customerPriceList->setRawData($key, $value);
		}

		return $customerPriceList;
	}
}
