<?php
namespace Cogensoft\PricingMatrix\Api;

use Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListUpdateInterface AS AdvancedPriceListUpdate;
use Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListInterface AS AdvancedPriceList;

interface AdvancedPriceListInterface
{
	/**
	 * Create advanced price list. Accepts single or array of advancedPriceList
	 * @param mixed $advancedPriceLists
	 * @return mixed
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @throws \Magento\Framework\Exception\CouldNotSaveException
	 * @api
	 */
	public function createPriceListAdvanced($advancedPriceLists);

	/**
	 * Get advanced price list by primary id
	 * @param int $primary
	 * @return \Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListInterface
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @api
	 */
    public function getPriceListAdvancedByPrimary($primary);

	/**
	 * Update advanced price list using primary id
	 * @param int $primary
	 * @param \Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListUpdateInterface $advancedPriceList
	 * @return \Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListUpdateInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @throws \Magento\Framework\Exception\CouldNotSaveException
	 * @api
	 */
	public function updatePriceListAdvancedByPrimary($primary, AdvancedPriceListUpdate $advancedPriceList);

	/**
	 * Delete advanced price list by primary id
	 * @param int $primary
	 * @return boolean
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @api
	 */
	public function deletePriceListAdvancedByPrimary($primary);
}
