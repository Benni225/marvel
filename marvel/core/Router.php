<?php
namespace marvel\core{
	use \marvel\package\Package,\marvel\abstractes\aSingleton;
	/**
	 * Routes to a in the URI specified controller and action and extractes
	 * Given parameters and values.
	 * @author Benjamin Werner
	 * @todo Integrate wildcards
	 */
	class Router extends aSingleton{
		/**
		 * The called controller.
		 * @var string
		 */
		public static $controller = "";
		/**
		 * The called action.
		 * @var string
		 */
		public static $action = "";
		/**
		 * The package to route to.
		 * @var string
		 */
		private static $package = "";
		/**
		 * Stores additional data from the url
		 * @var array
		 */
		private static $urlData = Array();
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iSingleton::create()
		 */
		public static function create(){
			if(self::$instance === NULL){
				self::$instance = new self;
			}
			return self::$instance;
		}
		/**
		 * Extractes the controller and the action out of the
		 * URI and the parameters with their values.
		 * @since 0.0.1
		 * @version 0.0.1 failure removed: instead of division it has to use modulo
		 */
		public function route(){
			$parameter = $_GET['param'];
			$parameter = explode("/", $parameter);
			if(count($parameter) % 2 != 0){
				/*
				 * No action is given.
				 * The first parameter is the name of the controller.
				 * The action has to be "{controllername}Init"
				 */
				self::$controller = $parameter[0];
				self::$action = $parameter[0]."Init";
				for($i = 1; $i < count($parameter); $i+=2)
					$urlParameters[$parameter[$i]] = $parameter[$i+1];
			}else{
				/*
				 * An action is given.
				 * The first parameter is the name of the controller,
				 * the second parameter is the name of the action. ({parameter2}Action).
				 */
				self::$controller = $parameter[0];
				self::$action = $parameter[1]."Action";
				for($i = 2; $i < count($parameter); $i+=2)
					$urlParameters[$parameter[$i]] = $parameter[$i+1];
			}
			//If there is something in $_GET, now it is also in our url-parameters
			$urlParameters[] = $_GET;
			self::$urlData = $urlParameters;
			self::$controller = Package::get(self::$package).self::$controller;

			return $this;
		}
		/**
		 * Change the package to route to.
		 * @param string $package
		 */
		public function usePackage($package){
			self::$package = $package;
		}
		/**
		 * Returns the singleton-instance.
		 */
		public static function get(){
			return self::$instance;
		}
		/**
		 * Returns the called controller.
		 * @return string
		 */
		public function controller(){
			return self::$controller;
		}
		/**
		 * Returns the called action.
		 * @return string
		 * Enter description here ...
		 */
		public function action(){
			return self::$action;
		}
		/**
		 * Returns the additional data from the url. For example:
		 *
		 * http://www.mysite.com/controller/action/username/Marcus/birthday/11-3-1988/
		 *
		 * will return an multidimensional array like:
		 * <code>
		 * <?php
		 * $urlData(
		 * 		'username'	=>	'Marcus',
		 * 		'birthday'	=>	'11-3-1988'
		 * )
		 * ?>
		 * </code>
		 * @return array
		 */
		public function urlData(){
			return self::$urlData;
		}


	}
}
