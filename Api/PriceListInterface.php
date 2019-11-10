<?php
namespace Cogensoft\PricingMatrix\Api;

use Cogensoft\PricingMatrix\Api\Data\PriceListUpdateInterface AS PriceListUpdate;
use Cogensoft\PricingMatrix\Api\Data\PriceListInterface AS PriceList;

interface PriceListInterface
{
	/**
	 * Create customer price list. Accepts single or array of priceList
	 * @param mixed $priceLists
	 * @return mixed
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @throws \Magento\Framework\Exception\CouldNotSaveException
	 * @api
	 */
	public function createPriceList($priceLists);

	/**
	 * Get customer price list by primary id
	 * @param int $primary
	 * @return \Cogensoft\PricingMatrix\Api\Data\PriceListInterface
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @api
	 */
    public function getPriceListByPrimary($primary);

	/**
	 * Update customer price list using primary id
	 * @param int $primary
	 * @param \Cogensoft\PricingMatrix\Api\Data\PriceListUpdateInterface $priceList
	 * @return \Cogensoft\PricingMatrix\Api\Data\PriceListUpdateInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @throws \Magento\Framework\Exception\CouldNotSaveException
	 * @api
	 */
	public function updatePriceListByPrimary($primary, PriceListUpdate $priceList);

	/**
	 * Delete customer price list by primary id
	 * @param int $primary
	 * @return boolean
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @api
	 */
	public function deletePriceListByPrimary($primary);
}
