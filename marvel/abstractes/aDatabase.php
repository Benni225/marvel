<?php
namespace marvel\abstractes{
	abstract class aDatabase extends aSingleton{
		protected static $instance = NULL;
		protected $driver;
		public function setDriver(aDatabaseDriver $driver){
			$this->driver = $driver;
		}

		abstract public function query($query);
	}
}