<?php

namespace Cogensoft\PricingMatrix\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 * @package Cogensoft\PricingMatrix\Setup
 */
class InstallSchema implements InstallSchemaInterface {
	/**
	 * Installs DB schema for a module
	 *
	 * @param SchemaSetupInterface $setup
	 * @param ModuleContextInterface $context
	 *
	 * @return void
	 */
	public function install( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;

		$installer->startSetup();

		/**
		 * Create table 'ml_pricing_price_advanced'
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable( 'ml_pricing_price_advanced' )
		)->addColumn(
			'id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			[ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true ],
			'price_advanced_primary'
		)->addColumn(
			'price_advanced_primary',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['unsigned' => true],
			'price_advanced_primary'
		)->addColumn(
			'price_advanced_prod',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			25,
			[ 'nullable' => true ],
			'price_advanced_prod'
		)->addColumn(
			'price_advanced_type',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			1,
			[ 'nullable' => true ],
			'price_advanced_type'
		)->addColumn(
			'price_advanced_discount',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_advanced_discount'
		)->addColumn(
			'price_advanced_fixed',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_advanced_fixed'
		)->addColumn(
			'price_advanced_prod_type',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			1,
			[ 'nullable' => true ],
			'price_advanced_prod_type'
		)->addColumn(
			'price_advanced_fixed_or_qty',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			[ 'nullable' => true ],
			'price_advanced_fixed_or_qty'
		)->addColumn(
			'price_advanced_parent',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			[ 'nullable' => true ],
			'price_advanced_parent'
		)->addColumn(
			'price_advanced_exclude',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_advanced_exclude'
		)->addColumn(
			'price_advanced_discount_cash',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_advanced_discount_cash'
		)->addColumn(
			'price_advanced_buy_qty',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_advanced_buy_qty'
		)->addColumn(
			'price_advanced_free_qty',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_advanced_free_qty'
		)->addColumn(
			'price_advanced_max_allow',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_advanced_max_allow'
		)->addColumn(
			'price_advanced_bogof_type',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			1,
			[ 'nullable' => true ],
			'price_advanced_bogof_type'
		)->addColumn(
			'price_advanced_min_qty',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_advanced_min_qty'
		)->addColumn(
			'price_advanced_chain',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_advanced_chain'
		)->addColumn(
			'price_advanced_loc1',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			25,
			[ 'nullable' => true ],
			'price_advanced_loc1'
		)->addColumn(
			'price_advanced_loc2',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			25,
			[ 'nullable' => true ],
			'price_advanced_loc2'
		)->addColumn(
			'price_advanced_loc3',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			25,
			[ 'nullable' => true ],
			'price_advanced_loc3'
		)->addColumn(
			'price_advanced_loc4',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			25,
			[ 'nullable' => true ],
			'price_advanced_loc4'
		)->addColumn(
			'price_advanced_loc5',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			25,
			[ 'nullable' => true ],
			'price_advanced_loc5'
		)->addColumn(
			'price_advanced_loc6',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			25,
			[ 'nullable' => true ],
			'price_advanced_loc6'
		)->addColumn(
			'price_advanced_bgf_same_or_dif_prod',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_advanced_bgf_same_or_dif_prod'
		)->addColumn(
			'price_advanced_bgf_prod_type',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			1,
			[ 'nullable' => true ],
			'price_advanced_bgf_prod_type'
		)->addColumn(
			'price_advanced_bgf_prod',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			25,
			[ 'nullable' => true ],
			'price_advanced_bgf_prod'
		)->addColumn(
			'price_advanced_bgf_apply_spl',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_advanced_bgf_apply_spl'
		)->addColumn(
			'price_advanced_ignore_discount',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_advanced_ignore_discount'
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_advanced', ['price_advanced_prod']),
			['price_advanced_prod']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_advanced', ['price_advanced_prod_type']),
			['price_advanced_prod_type']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_advanced', ['price_advanced_exclude']),
			['price_advanced_exclude']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_advanced', ['price_advanced_parent']),
			['price_advanced_parent']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_advanced', ['price_advanced_fixed_or_qty']),
			['price_advanced_fixed_or_qty']
		)->setComment(
			'Price Advanced'
		);
		$installer->getConnection()->createTable( $table );

		/**
		 * Create table 'ml_pricing_price_customer'
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable( 'ml_pricing_price_customer' )
		)->addColumn(
			'id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			[ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true ],
			'price_advanced_primary'
		)->addColumn(
			'price_customer_primary',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['unsigned' => true],
			'price_customer_primary'
		)->addColumn(
			'price_customer_parent',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			25,
			[ 'nullable' => true ],
			'price_customer_parent'
		)->addColumn(
			'price_customer_type',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			1,
			[ 'nullable' => true ],
			'price_customer_type'
		)->addColumn(
			'price_customer_char',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			20,
			[ 'nullable' => true ],
			'price_customer_char'
		)->addColumn(
			'price_customer_exclude',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_customer_exclude'
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_customer', ['price_customer_parent']),
			['price_customer_parent']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_customer', ['price_customer_exclude']),
			['price_customer_exclude']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_customer', ['price_customer_char']),
			['price_customer_char']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_customer', ['price_customer_type']),
			['price_customer_type']
		)->setComment(
			'Price Customer'
		);
		$installer->getConnection()->createTable( $table );

		/**
		 * Create table 'ml_pricing_price_detail'
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable( 'ml_pricing_price_detail' )
		)->addColumn(
			'id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			[ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true ],
			'price_advanced_primary'
		)->addColumn(
			'price_detail_primary',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['unsigned' => true],
			'price_detail_primary'
		)->addColumn(
			'price_detail_header',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			[ 'nullable' => true ],
			'price_detail_header'
		)->addColumn(
			'price_detail_from',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_detail_from'
		)->addColumn(
			'price_detail_to',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_detail_to'
		)->addColumn(
			'price_detail_fixed',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_detail_fixed'
		)->addColumn(
			'price_detail_discount',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_detail_discount'
		)->addColumn(
			'price_detail_type',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			1,
			[ 'nullable' => true ],
			'price_detail_type'
		)->addColumn(
			'price_detail_discount_cash',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_detail_discount_cash'
		)->addColumn(
			'price_detail_chain',
			\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
			null,
			[ 'nullable' => true ],
			'price_detail_chain'
		)->addColumn(
			'price_detail_ignore_discount',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_detail_ignore_discount'
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_detail', ['price_detail_from']),
			['price_detail_from']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_detail', ['price_detail_to']),
			['price_detail_to']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_detail', ['price_detail_header']),
			['price_detail_header']
		)->setComment(
			'Price Detail'
		);
		$installer->getConnection()->createTable( $table );

		/**
		 * Create table 'ml_pricing_price_list'
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable( 'ml_pricing_price_list' )
		)->addColumn(
			'id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			[ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true ],
			'price_advanced_primary'
		)->addColumn(
			'price_list_primary',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['unsigned' => true],
			'price_list_primary'
		)->addColumn(
			'price_list_name',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			50,
			[ 'nullable' => true ],
			'price_list_name'
		)->addColumn(
			'price_list_effective',
			\Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
			null,
			[ 'nullable' => true ],
			'price_list_effective'
		)->addColumn(
			'price_list_notes',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			null,
			[ 'nullable' => true ],
			'price_list_notes'
		)->addColumn(
			'price_list_active',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_list_active'
		)->addColumn(
			'price_list_priority',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			11,
			[ 'nullable' => true ],
			'price_list_priority'
		)->addColumn(
			'price_list_currency',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			5,
			[ 'nullable' => true ],
			'price_list_currency'
		)->addColumn(
			'price_list_effective_to',
			\Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
			null,
			[ 'nullable' => true ],
			'price_list_effective_to'
		)->addColumn(
			'price_list_crystal_rep',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			200,
			[ 'nullable' => true ],
			'price_list_crystal_rep'
		)->addColumn(
			'price_list_type',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			10,
			[ 'nullable' => true ],
			'price_list_type'
		)->addColumn(
			'price_list_sub_filter',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_list_sub_filter'
		)->addColumn(
			'price_list_override',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_list_override'
		)->addColumn(
			'price_list_show_prompt',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_list_show_prompt'
		)->addColumn(
			'price_list_use_sub_methods',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_list_use_sub_methods'
		)->addColumn(
			'price_list_match_all_customers',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_list_match_all_customers'
		)->addColumn(
			'price_list_match_all_products',
			\Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
			6,
			[ 'nullable' => true ],
			'price_list_match_all_products'
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_list', ['price_list_effective']),
			['price_list_effective']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_list', ['price_list_active']),
			['price_list_active']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_list', ['price_list_effective_to']),
			['price_list_effective_to']
		)->addIndex(
			$installer->getIdxName('ml_pricing_price_list', ['price_list_priority']),
			['price_list_priority']
		)->setComment(
			'Price List'
		);
		$installer->getConnection()->createTable( $table );

		$installer->endSetup();
	}
}