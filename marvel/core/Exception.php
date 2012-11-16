<?php
namespace marvel\core;
class Exception extends \Exception{
	public function __construct($message, $code=''){
		parent::__construct($message);
	}
}