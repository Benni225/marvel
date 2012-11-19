<?php
namespace marvel\abstractes{
	abstract class aDatabase extends aSingleton{
		protected $driver;
		public function setDriver(aDatabaseDriver $driver){
			$this->driver = $driver;
		}

		abstract public function query($query);
	}
}