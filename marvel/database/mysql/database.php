<?php
namespace marvel\database\mysql{
	use marvel\abstractes\aDatabase;
	class database extends aDatabase{

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

		public function connect($parameters, $driver = NULL){
			if($driver == NULL){
				$this->setDriver(new driver());
			}else{
				$this->setDriver(new $driver());
			}
			$this->driver->__connect($parameters);
			return $this;
		}

		public function query($query){
			$this->driver->__query($this->driver->__prepare($query));
			return $this;
		}

		public function result(){
			return $this->driver->__result();
		}

		public function isConnected(){
			return $this->driver->__isConnected();
		}

		public function affectedRows(){
			return $this->driver->__affectedRows();
		}

		public function error(){
			return $this->driver->__error();
		}
	}
}