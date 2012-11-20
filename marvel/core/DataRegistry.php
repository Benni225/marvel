<?php
namespace marvel\core{
	use marvel\abstractes\aSingleton, marvel\interfaces\iRegistry;
	/**
	 * Stores every kind of data.
	 * @author Benjamin Werner
	 *
	 */
	class DataRegistry extends aSingleton implements iRegistry{
		protected static $instance = NULL;
		/**
		 * Array that includes every kind of data.
		 * @var array
		 */
		private static $registry = Array();
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
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iRegistry::add()
		 */
		public static function add($name, $data, $dataHandler){
			self::$registry[$name] = $dataHandler;
			self::$registry[$name]->set($data);
		}
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iRegistry::get()
		 */
		public static function get($name){
			if(array_key_exists($name, self::$registry)){
				return self::$registry[$name]->get();
			}else{
				return NULL;
			}
		}
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iRegistry::update()
		 */
		public static function update($name, $data){
			if(array_key_exists($name, self::$registry[$name])){
				self::$registry[$name]->set($data);
				return true;
			}else{
				return false;
			}
		}
	}
}