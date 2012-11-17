<?php
use marvel\core\Application;
use marvel\datahandler\Post;
namespace marvel\core{
	use \marvel\package\Package,
	\marvel\datahandler\Data,
	\marvel\datahandler\PackageData;
	/**
	 * Manage the application. Runs the router, stores data from GET and POST
	 *
	 * @author Benjamin Werner
	 * @version 0.0.1
	 *
	 */
	class Application{
		/**
		 * Name of the controllerclass
		 * @var string
		 */
		public static $controller = "";
		/**
		 * Name of the action-method.
		 * @var String
		 */
		public static $action = "";
		/**
		 * Object that stores the POST-data.
		 * @var Post
		 */
		public static $dataPost;
		/**
		 * Object that stores the GET-data
		 * @var Get
		 */
		public static $dataGet;
		/**
		 * The application-package to route to.
		 * @var string
		 */
		private static $applicationPackage = "";
		/**
		 * Singleton-instance
		 * @var Application
		 */
		private static $instance = NULL;

		private function __construct(){}
		private function __clone(){}

		/**
		 * Initialize the application and add the standard-package.
		 * @return Application
		 */
		public static function create(){
			Package::addPackage("applicationPackage", "app\controller", new PackageData());
			Router::create()->usePackage("applicationPackage");
			if(self::$instance === NULL){
				self::$instance = new self;
			}
			return self::$instance;
		}
		/**
		 * Routes and run the calld controller and the called action.
		 */
		public static function run(){
			Router::get()->route();
			self::setController(Router::get()->controller());
			self::setAction(Router::get()->action());
			self::storeData();

			$obj = new self::$controller;
			$obj->{self::$action}();
		}
		/**
		 * Set the called controller.
		 * @param string $controller
		 */
		public static function setController($controller){
			self::$controller = $controller;
		}
		/**
		 * Set the called action.
		 * @param string $action
		 */
		public static function setAction($action){
			self::$action = $action;
		}
		/**
		 * Stores the POST-data and GET-data.
		 * @todo Add GET
		 */
		public static function storeData(){
			DataRegistry::add("POST", $_POST, new Data());
			DataRegistry::add("GET", Router::get()->urlData(), new Data());
		}
		/**
		 * Sets the package-name to use as application.
		 * @param string $package
		 */
		public function usePackage($package){
			Router::get()->usePackage($package);
		}
	}
}