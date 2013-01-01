<?php
class Model extends aModel{
	private $DEFAULT_QUERYBUILDER = "MySqlQuerybuilder";
	private $__id;
	private $__tableColumns;
	private $__querybuilder;
	public function __construct(){
		$r = new ReflectionClass($this);
		$this->__tableColumns = new AssoziativArrayIterator($r->getDefaultProperties());
		$this->__tableColumns->each(function($index, $value, $instance){
			echo "<br />";
			var_dump($value);
			if(strtolower($index) == 'id')
				$instance->__id = $index;
			elseif(in_array('id', $value))
				$instance->__id = $index;
		}, $this);
		$this->setQuerybuilder($this->DEFAULT_QUERYBUILDER);
	}
}