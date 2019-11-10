<?php
namespace Cogensoft\PricingMatrix\Plugin;

use Magento\Catalog\Model\Product AS MagentoProduct;
use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\App\ResourceConnection;

class Product
{
	const TABLES = [
		'ml_pricing_price_customer',
		'ml_pricing_price_advanced',
		'ml_pricing_price_detail',
		'ml_pricing_price_list',
		'customer_grid_flat',
		'catalog_product_flat_1'
	];

	/**
	 * @var \Magento\Framework\App\ResourceConnection
	 */
	protected $resourceConnection;

	/**
	 * @var \Magento\Customer\Model\Customer
	 */
	protected $parentCustomer;

	/**
	 * @var \Magento\Framework\DB\Adapter\AdapterInterface
	 */
	protected $db;

	/**
	 * @var array
	 */
	protected $tablesNames;

	public function __construct(
		ResourceConnection $resourceConnection,
		SessionFactory $sessionFactory,
		CustomerFactory $customerFactory
	) {
		$this->resourceConnection = $resourceConnection;

		$customerSession = $sessionFactory->create();
		if($customerSession->isLoggedIn()) {
			$subaccountTransportDataObject = $customerSession->getSubaccountData();
			$this->parentCustomer = ($subaccountTransportDataObject)
				? $customerFactory->create()->load($subaccountTransportDataObject->getParentCustomerId())
				: $customerSession->getCustomer();
		}


		$this->db = $this->resourceConnection->getConnection();
		$this->setTableNames();
	}

	public function afterGetPrice(MagentoProduct $product, $price)
	{
		//TODO - Waiting on the customer to confirm if the quantity breaks are required on the product page, if so need to lift and shift the function from here and put in an AJAX controller
		//TODO - Populate product and customwr sort fields in product and customer tables
		//TODO - Handle qty i.e. if multiple already in the cart

		if($this->parentCustomer) {
			//Customer logged in
			$productSku = $product->getSku();
			$customerAccountCode = $this->parentCustomer->getCustomerAccNumber();
			$price = $this->calculatePrice($price, $customerAccountCode, $productSku, 1);
		}

		return $price;
	}

	protected function setTableNames() {
		foreach(self::TABLES AS $tableName) {
			$this->tablesNames[$tableName] = $this->resourceConnection->getTableName($tableName);
		}
	}

	protected function substituteTableName($rawSql) {
		foreach($this->tablesNames AS $intTableName => $extTableName) {
			$rawSql = str_replace($intTableName, $extTableName, $rawSql);
		}

		return $rawSql;
	}

	protected function calculatePrice($pprice, $saccount, $partcode, $quantity) {

		$rawSql = $this->substituteTableName("SELECT price_list_primary, price_list_name, ml_pricing_price_advanced.*, customer_grid_flat.* 
			FROM ml_pricing_price_list, ml_pricing_price_advanced, catalog_product_flat_1, ml_pricing_price_customer, customer_grid_flat
			WHERE price_list_active=1 AND NOW()>price_list_effective AND NOW()<price_list_effective_to AND price_list_primary=price_advanced_parent 
			AND price_list_primary=price_customer_parent AND price_advanced_exclude=0 AND price_customer_exclude=0 
			AND customer_acc_number = :customer_account_number 
			AND sku = :sku
			AND (
				price_advanced_fixed_or_qty=0 OR (
					price_advanced_fixed_or_qty=1 AND 1 IN (
						SELECT 1 FROM ml_pricing_price_detail WHERE price_detail_header=ml_pricing_price_advanced.price_advanced_primary 
						AND :quantity >= price_detail_from 
						AND :quantity <= price_detail_to
					)
				)
			)
			AND (
				(price_advanced_prod=sku AND price_advanced_prod_type='C')
				OR (price_advanced_prod=product_sort AND price_advanced_prod_type='S')
				OR (price_advanced_prod=product_sort1 AND price_advanced_prod_type='1')
				OR (price_advanced_prod=product_sort2 AND price_advanced_prod_type='2')
				OR (price_advanced_prod=product_sort3 AND price_advanced_prod_type='3')
			)
			AND (
				(price_customer_char=customer_acc_number AND price_customer_type='C')
				OR (price_customer_char=customer_sort AND price_customer_type='S')
				OR (price_customer_char=customer_sort1 AND price_customer_type='1')
				OR (price_customer_char=customer_sort2 AND price_customer_type='2')
				OR (price_customer_char=customer_sort3 AND price_customer_type='3')
			) AND sku NOT IN (
				SELECT sku FROM ml_pricing_price_advanced, catalog_product_flat_1 WHERE price_advanced_parent=price_list_primary AND price_advanced_exclude=1
				AND (
					(price_advanced_prod=sku AND price_advanced_prod_type='C')
					OR (price_advanced_prod=product_sort AND price_advanced_prod_type='S')
					OR (price_advanced_prod=product_sort1 AND price_advanced_prod_type='1')
					OR (price_advanced_prod=product_sort2 AND price_advanced_prod_type='2')
					OR (price_advanced_prod=product_sort3 AND price_advanced_prod_type='3')
				)
			) 
			AND customer_acc_number NOT IN (
				select customer_acc_number from ml_pricing_price_customer, customer_grid_flat WHERE price_customer_exclude=1
				AND price_customer_parent=price_list_primary
				AND (
					(price_customer_char=customer_acc_number AND price_customer_type='C')
					OR (price_customer_char=customer_sort AND price_customer_type='S')
					OR (price_customer_char=customer_sort1 AND price_customer_type='1')
					OR (price_customer_char=customer_sort2 AND price_customer_type='2')
					OR (price_customer_char=customer_sort3 AND price_customer_type='3')
				)
			)
			ORDER BY 
			CASE price_customer_type WHEN 'C' THEN 1 WHEN 'S' THEN 2 WHEN '1' THEN 3 WHEN '2' THEN 4 WHEN '3' THEN 5 END, price_list_priority,
			CASE price_advanced_prod_type WHEN 'C' THEN 1 WHEN 'S' THEN 2 WHEN '1' THEN 3 WHEN '2' THEN 4 WHEN '3' THEN 5 END, price_list_priority;");

		$binds = [
			'customer_account_number' => $saccount,
			'sku' => $partcode,
			'quantity' => $quantity
		];

		$query = $this->db->query($rawSql, $binds);
		$row = $query->fetch();
		if($row) {
			$stp_primary = $row['price_advanced_primary'];
			$stp_type = $row['price_advanced_type'];
			$stp_fixed_or_qty = $row['price_advanced_fixed_or_qty'];

			if ($stp_fixed_or_qty == 0) {
				if ( $stp_type == "0" ) {
					$pprice = $row['price_advanced_fixed'];
				} else {
					$stp_disc = $row['price_advanced_discount'];
					if ( $stp_disc == 0 ) {
						$stp_disc_cash = $row['price_advanced_discount_cash'];
						$pprice        = $pprice - $stp_disc_cash;
					} else {
						$pprice = $pprice * (( 100 - $stp_disc ) / 100 );
					}
				}
			} else {
				$rawSql = $this->substituteTableName("SELECT * FROM stk_price_matrix_det WHERE stpd_header = :price_list_primary AND :quantity BETWEEN price_detail_from AND price_detail_to");

				$binds = [
					'price_list_primary' => $stp_primary,
					'quantity' => $quantity
				];

				$query = $this->db->query($rawSql, $binds);
				$row = $query->fetch();
				if($row) {
					$stpd_type = $row['price_detail_type'];
					$stpd_fixed = $row['price_detail_fixed'];
					if ($stpd_type == "0") {
						$pprice = $stpd_fixed;
					} else {
						$stpd_disc = $row['price_detail_discount'];
						if ($stpd_disc == 0) {
							$stpd_disc_cash = $row['price_detail_discount_cash'];
							$pprice = $pprice - $stpd_disc_cash;
						} else {
							$pprice = $pprice * ((100 - $stpd_disc) / 100);
						}
					}
				}
			}
		}

		return round($pprice + 0.00005,2);
	}


//    protected function getqtybreaks($pprice, $saccount, $partcode) {
//		$qbresult="";
//		$rawSql = $this->substituteTableName("SELECT price_list_primary, price_list_name, ml_pricing_price_advanced.* ,customer_grid_flat.*
//			FROM ml_pricing_price_list, ml_pricing_price_advanced,catalog_product_flat_1, ml_pricing_price_customer, customer_grid_flat
//			WHERE price_list_active=1 AND NOW()>price_list_effective AND NOW()<price_list_effective_to
//			AND price_list_primary=price_advanced_parent AND price_list_primary=price_customer_parent AND price_advanced_exclude=0
//			AND price_customer_exclude=0
//			AND customer_acc_number = :customer_account_number
//			AND sku = :sku
//			AND (
//				price_advanced_fixed_or_qty=0 OR (
//					price_advanced_fixed_or_qty=1 AND 1 IN (
//						SELECT 1 FROM ml_pricing_price_detail WHERE price_detail_header=ml_pricing_price_advanced.price_advanced_primary
//					)
//				)
//			)
//			AND (
//				(price_advanced_prod=sku AND price_advanced_prod_type='C')
//				OR (price_advanced_prod=product_sort AND price_advanced_prod_type='S')
//				OR (price_advanced_prod=product_sort1 AND price_advanced_prod_type='1')
//				OR (price_advanced_prod=product_sort2 AND price_advanced_prod_type='2')
//				OR (price_advanced_prod=product_sort3 AND price_advanced_prod_type='3')
//			)
//			AND (
//				(price_customer_char=customer_acc_number AND price_customer_type='C')
//				OR (price_customer_char=customer_sort AND price_customer_type='S')
//				OR (price_customer_char=customer_sort1 AND price_customer_type='1')
//				OR (price_customer_char=customer_sort2 AND price_customer_type='2')
//				OR (price_customer_char=customer_sort3 AND price_customer_type='3')
//			)
//			AND sku NOT IN (
//				SELECT sku
//				FROM ml_pricing_price_advanced, catalog_product_flat_1
//				WHERE price_advanced_parent=price_list_primary AND price_advanced_exclude=1
//				AND (
//					(price_advanced_prod=sku AND price_advanced_prod_type='C')
//					OR (price_advanced_prod=product_sort AND price_advanced_prod_type='S')
//					OR (price_advanced_prod=product_sort1 AND price_advanced_prod_type='1')
//					OR (price_advanced_prod=product_sort2 AND price_advanced_prod_type='2')
//					OR (price_advanced_prod=product_sort3 AND price_advanced_prod_type='3')
//				)
//			)
//			AND customer_acc_number NOT IN (
//				SELECT customer_acc_number
//				FROM ml_pricing_price_customer, customer_grid_flat
//				WHERE price_customer_exclude=1
//				AND price_customer_parent=price_list_primary
//				AND (
//					(price_customer_char=customer_acc_number AND price_customer_type='C')
//					OR (price_customer_char=customer_sort AND price_customer_type='S')
//					OR (price_customer_char=customer_sort1 AND price_customer_type='1')
//					OR (price_customer_char=customer_sort2 AND price_customer_type='2')
//					OR (price_customer_char=customer_sort3 AND price_customer_type='3')
//				)
//			)
//			ORDER BY CASE price_advanced_prod_type WHEN 'C' THEN 1 WHEN 'S' THEN 2 WHEN '1' THEN 3 WHEN '2' THEN 4 WHEN '3' THEN 5 END, price_list_priority,
//			CASE price_customer_type WHEN 'C' THEN 1 WHEN 'S' THEN 2 WHEN '1' THEN 3 WHEN '2' THEN 4 WHEN '3' THEN 5 END, price_list_priority");
//
//		$binds = [
//			'customer_account_number' => $saccount,
//			'sku' => $partcode,
//		];
//
//		$query = $this->db->query($rawSql, $binds);
//		$row = $query->fetch();
//		if($row) {
//			$stp_primary = $row['price_advanced_primary'];
//			$stp_type = $row['price_advanced_type'];
//			$stp_fixed_or_qty = $row['price_advanced_fixed_or_qty'];
//			if ($stp_fixed_or_qty == 0) {
//				if ($stp_type == "0") {
//					$pprice = $row['price_advanced_fixed'];
//				} else {
//					$stp_disc = $row['price_advanced_discount'];
//					if ($stp_disc == 0) {
//						$stp_disc_cash = $row['price_detail_discount_cash'];
//						$pprice = $pprice - $stp_disc_cash;
//					} else {
//						$pprice = $pprice * ( (100-$stp_disc) / 100);
//					}
//				}
//			} else {
//				$rawSql = $this->substituteTableName("SELECT * FROM ml_pricing_price_detail WHERE price_detail_header = :price_advanced_primary AND price_detail_from > 1 ORDER BY price_detail_from");
//
//				$binds = [
//					'price_advanced_primary' => $stp_primary
//				];
//
//				$query = $this->db->query($rawSql, $binds);
//				$qbresult = $query->fetch();
//			}
//		}
//
//		return $qbresult;
//	}
}