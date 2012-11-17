<?php
namespace marvel\core;
/**
 * Exception-class.
 * @author Benjamin Werner
 *
 */
class Exception extends \Exception{
	public function __construct($message, $code=''){
		parent::__construct($message);
	}
}