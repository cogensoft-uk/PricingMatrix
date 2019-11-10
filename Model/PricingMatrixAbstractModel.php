<?php
namespace Cogensoft\PricingMatrix\Model;

abstract class PricingMatrixAbstractModel extends \Magento\Framework\Model\AbstractModel {

	protected static $PREFIX;

	public function setRawData( $key, $value = null ) {
		$key = $this->getDbFieldFromKey($key);

		return parent::setData( $key, $value );
	}

	public function getRawData( $key = '', $index = null ) {
		if($key) {
			$key = $this->getDbFieldFromKey($key);
			return parent::getData( $key, $index );
		}

		$allData = [];
		foreach(parent::getData( '', $index ) AS $key => $value) {
			$allData[$this->getKeyFromDbField($key)] = $value;
		}

		return $allData;
	}

	protected function getDbFieldFromKey($key) {
		return ( $key == 'id' ) ? $key : static::$PREFIX . $key;
	}

	protected function getKeyFromDbField($key) {
		return ( $key == 'id' ) ? $key : str_replace(static::$PREFIX, '', $key);
	}
}
