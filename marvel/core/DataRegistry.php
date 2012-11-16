<?php
namespace marvel\core{
	class DataRegistry extends \marvel\abstractes\aSingleton implements \marvel\interfaces\iRegistry{
		private static $registry = Array();
		public static function create(){
			if(self::$instance === NULL){
				self::$instance = new self;
			}
			return self::$instance;
		}
		public static function add($name, $data, $dataHandler){
			self::$registry[$name] = $dataHandler;
			self::$registry[$name]->set($data);
		}

		public static function get($name){
			if(array_key_exists($name, self::$registry)){
				return self::$registry[$name]->get();
			}else{
				return NULL;
			}
		}

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