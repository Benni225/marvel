<?php
namespace marvel\core{
	use \marvel\package\Package,
	\marvel\datahandler\Post,
	\marvel\datahandler\PackageData;
	class Application{
		public static $controller = "";
		public static $action = "";
		public static $dataPost;
		public static $dataGet;
		private static $applicationPackage = "";
		private static $instance = NULL;

		private function __construct(){}
		private function __clone(){}

		public static function create(){
			Package::addPackage("applicationPackage", "app\controller", new PackageData());
			Router::create()->usePackage("applicationPackage");
			if(self::$instance === NULL){
				self::$instance = new self;
			}
			return self::$instance;
		}

		public static function run(){
			Router::get()->route();
			self::setController(Router::get()->controller());
			self::setAction(Router::get()->action());
			self::storeData();

			$obj = new self::$controller;
			$obj->{self::$action}();
		}

		public static function setController($controller){
			self::$controller = $controller;
		}

		public static function setAction($action){
			self::$action = $action;
		}

		public static function storeData(){
			DataRegistry::add("POST", $_POST, new Post());
		}

		public function usePackage($package){
			Router::get()->usePackage($package);
		}
	}
}