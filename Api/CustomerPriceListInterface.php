<?php
namespace Cogensoft\PricingMatrix\Api;

use Cogensoft\PricingMatrix\Api\Data\CustomerPriceListUpdateInterface as CustomerPriceListUpdate;
use Cogensoft\PricingMatrix\Api\Data\CustomerPriceListInterface AS CustomerPriceList;

interface CustomerPriceListInterface
{

	/**
	 * Create customer price list. Accepts single or array of customerPriceList
	 *
	 * @param mixed $customerPriceLists
	 *
	 * @return mixed $customerPriceList
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @throws \Magento\Framework\Exception\CouldNotSaveException
	 * @api
	 */
	public function createCustomerPriceList($customerPriceLists);

    /**
     * Get customer price list by primary id
     * @param int $primary
     * @return \Cogensoft\PricingMatrix\Api\Data\CustomerPriceListInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @api
     */
    public function getCustomerPriceListByPrimary($primary);

	/**
	 * Update customer price list using primary id
	 * @param int $primary
	 * @param \Cogensoft\PricingMatrix\Api\Data\CustomerPriceListUpdateInterface $customerPriceList
	 * @return \Cogensoft\PricingMatrix\Api\Data\CustomerPriceListUpdateInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @throws \Magento\Framework\Exception\CouldNotSaveException
	 * @api
	 */
	public function updateCustomerPriceListByPrimary($primary, CustomerPriceListUpdate $customerPriceList);

	/**
	 * Delete customer price list by primary id
	 * @param int $primary
	 * @return boolean
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @api
	 */
	public function deleteCustomerPriceListByPrimary($primary);
}
