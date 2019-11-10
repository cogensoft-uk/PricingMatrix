<?php

namespace Cogensoft\PricingMatrix\Traits\API;

use Magento\Framework\Exception\InputException;

trait Validator {
	/**
	 * Validate data.
	 *
	 * @param mixed
	 *
	 * @return mixed
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Zend_Validate_Exception
	 */
	protected function validate($model, $rules)
	{
		$exception = new InputException();

		foreach($rules AS $field => $fieldRules) {
			$getMethod = 'get'.$this->camelize($field);
			$value = call_user_func([$model, $getMethod]);

			foreach($fieldRules AS $zendValidationClassName => $validationParams) {

				switch($zendValidationClassName) {
					case 'InArray':
						$validationConfig = new \Zend_Config(array_merge(['haystack' => []], $validationParams));
						$validator = new \Zend_Validate_InArray($validationConfig);
						$validationResult = $validator->isValid($value);
						break;
					default:
						$validationResult = ($validationParams)
							? \Zend_Validate::is($value, $zendValidationClassName, $validationParams)
							: \Zend_Validate::is($value, $zendValidationClassName);
						break;
				}

				if (!$validationResult) {
					$exception->addError(
						__(
							"Failed validation of rule: ".$zendValidationClassName,
							[
								'fieldName' => $field,
								'class' => get_class($model),
								'method' => $getMethod,
								'value' => $value
							]
						)
					);
				}
			}
		}

		if ($exception->wasErrorAdded()) {
			throw $exception;
		}

		return $this;
	}

	protected function camelize($string) {
		return str_replace('_', '', ucwords($string, '_'));
	}
}