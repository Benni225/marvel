<?php
/**
 * Manage the application. Runs the router, stores data from GET and POST
 *
 * @author Benjamin Werner
 * @version 0.0.1
 *
 */
class Application extends aSingleton{
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
	private static $configuration = Array();
	/**
	 * Initialize the application and add the standard-package.
	 * @return Application
	 */
	public static function create(){
		Package::addPackage("app", "app/", new PackageData());
		//Initialize the app
		require_once Package::get("app")."boot.php";

		Router::create()->route();
		self::setController(Router::get()->controller());
		self::setAction(Router::get()->action());
		self::storeData();

		if(self::$instance === NULL){
			self::$instance = new self;
		}
		return self::$instance;
	}
	/**
	 * Sets the configuration of the application. Normaly called in boot.php.
	 * @param array $configuration
	 */
	public static function configuration(Array $configuration){
		self::$configuration = $configuration;
	}
	/**
	 * Routes and run the called controller and the called action.
	 */
	public static function run(){
		if(empty(self::$action)){
			self::setAction(self::$configuration['defaultAction']);
		}
		$obj = new self::$controller;
		$output = $obj->{self::$action}();
		self::output($output);
	}
	/**
	 *
	 * Set the called controller.
	 * @param string $controller
	 */
	public static function setController($controller){
		self::$controller = empty($controller)?"Controller_".self::$configuration['defaultController']:"Controller_".$controller;
	}
	/**
	 * Set the called action.
	 * @param string $action
	 */
	public static function setAction($action){
		self::$action = empty($action)?self::$configuration['defaultAction'].'Action':$action.'Action';
	}
	/**
	 * Stores the POST-data and GET-data.
	 */
	public static function storeData(){
		DataRegistry::add("POST", $_POST, new Data());
		DataRegistry::add("GET", Router::get()->urlData(), new Data());
	}

	/**
	 * Creates the output of the application.
	 * @param mixed $output
	 */
	private static function output($output){
		echo $output;
	}
}