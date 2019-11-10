<?php
namespace Cogensoft\PricingMatrix\Api;

use Cogensoft\PricingMatrix\Api\Data\DetailPriceListUpdateInterface AS DetailPriceListUpdate;
use Cogensoft\PricingMatrix\Api\Data\DetailPriceListInterface AS DetailPriceList;

interface DetailPriceListInterface
{
	/**
	 * Create customer price list. Accepts single or array of detailPriceList
	 *
	 * @param mixed $detailPriceLists
	 * @return mixed
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @throws \Magento\Framework\Exception\CouldNotSaveException
	 * @api
	 */
	public function createPriceListDetail($detailPriceLists);

	/**
	 * Get customer price list by primary id
	 *
	 * @param int $primary
	 * @return \Cogensoft\PricingMatrix\Api\Data\DetailPriceListInterface
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @api
	 */
    public function getPriceListDetailByPrimary($primary);

	/**
	 * Update customer price list using primary id
	 *
	 * @param int $primary
	 * @param \Cogensoft\PricingMatrix\Api\Data\DetailPriceListUpdateInterface $detailPriceList
	 * @return \Cogensoft\PricingMatrix\Api\Data\DetailPriceListUpdateInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @throws \Magento\Framework\Exception\CouldNotSaveException
	 * @api
	 */
	public function updatePriceListDetailByPrimary($primary, DetailPriceListUpdate $detailPriceList);

	/**
	 * Delete customer price list by primary id
	 * @param int $primary
	 * @return boolean
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 * @throws \Magento\Framework\Exception\LocalizedException
	 * @api
	 */
	public function deletePriceListDetailByPrimary($primary);
}
