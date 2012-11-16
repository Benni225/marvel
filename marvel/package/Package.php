<?php
namespace marvel\package{
	class Package extends \marvel\core\DataRegistry{
		public static function addPackage($name, $namespace, $dataHandler){
			if(substr($namespace, 0, -1) != "\\"){
				$namespace.="\\";
			}
			if(substr($namespace, 0, 1) != "\\"){
				$namespace="\\".$namespace;
			}
			self::add($name, $namespace, $dataHandler);
		}
	}
}