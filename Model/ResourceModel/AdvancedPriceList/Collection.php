<?php
namespace Cogensoft\PricingMatrix\Model\ResourceModel\AdvancedPriceList;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Cogensoft\PricingMatrix\Model\AdvancedPriceList', 'Cogensoft\PricingMatrix\Model\ResourceModel\AdvancedPriceList');
	}
}