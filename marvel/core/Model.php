<?php
namespace marvel\core{
	use \Reflection;
	use \ReflectionClass;
	use \ReflectionProperty;
	use \ReflectionObject;
	use \marvel\iterators\AssoziativArrayIterator;
	class Model extends \marvel\abstractes\aModel{
		private $__id;
		private $__tableColumns;
		public function __construct(){
			$r = new ReflectionClass($this);
			$this->__tableColumns = new AssoziativArrayIterator($r->getDefaultProperties());
			$this->__tableColumns->each(function($index, $value, $instance){
				var_dump($value);
				echo "<br />";
				if(strtolower($index) == 'id')
					$instance->__id = $index;
				elseif(in_array("id", $value))
					$instance->__id = $index;
			}, $this);
		}
	}
}