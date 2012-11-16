<?php
namespace marvel\core{
	use \marvel\package\Package,\marvel\abstractes\aSingleton;

	class Router extends aSingleton{
		public static $controller;
		public static $action;
		private static $package;

		public static function create(){
			if(self::$instance === NULL){
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function route(){
			$parameter = $_GET['param'];
			$parameter = explode("/", $parameter);
			if(count($parameter) / 2 != 0){
				/*
				 * No action is given.
				 * The first parameter is the name of the controller.
				 * The action has to be "{controllername}Init"
				 */
				self::$controller = $parameter[0];
				self::$action = $parameter[0]."Init";
			}else{
				/*
				 * An action is given.
				 * The first parameter is the name of the controller,
				 * the second parameter is the name of the action. ({parameter2}Action).
				 */
				self::$controller = $parameter[0];
				self::$action = $parameter[1]."Action";
			}
			self::$controller = Package::get(self::$package).self::$controller;

			return $this;
		}

		public function usePackage($package){
			self::$package = $package;
		}

		public static function get(){
			return self::$instance;
		}

		public function controller(){
			return self::$controller;
		}

		public function action(){
			return self::$action;
		}


	}
}
