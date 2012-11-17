<?php
namespace marvel\package{
	use marvel\core\DataRegistry;
	/**
	 * At the moment this class stores different application-packages.
	 * @author Benjamin Werner
	 *
	 */
	class Package extends DataRegistry{
		/**
		 * Adds a new package. Packages are applications driven by the router.
		 * A package is equal to the namespace of a class, at the beginning and
		 * the end there has to be a "\".
		 * @param String $name
		 * @param String $namespace
		 * @param  Object $dataHandler
		 */
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