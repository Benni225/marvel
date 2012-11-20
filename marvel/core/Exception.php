<?php
namespace marvel\core;
/**
 * Exception-class.
 * @author Benjamin Werner
 *
 */
class Exception extends \Exception{
	public function __construct($message, $code=''){
		$this->message = $message;
		$this->code = $code;
		$this->output();
	}

	public function output(){
		print $this->message.PHP_EOL."\n\r";
		print "Error: ".$this->code.PHP_EOL."\n\r";
		print $this->getCode().PHP_EOL."\n\r";
		print "On line: ".$this->getLine().PHP_EOL."\n\r";
		print "In File: ".$this->getFile().PHP_EOL."\n\r";

	}
}