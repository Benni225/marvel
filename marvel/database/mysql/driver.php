<?php
namespace marvel\database\mysql{
	use marvel\core\Exception;

	use marvel\abstractes\aDatabaseDriver;
	class driver extends aDatabaseDriver{
		private $result;
		protected function __connect(Array $parameters){
			if($parameters['database'] == "" || $parameters['database'] == NULL){
				throw new marvel\core\Exception("Can not select a database. No database given!");
			}else{
				if($parameters['newLink'] == "" || $parameters['newLink'] == NULL) $parameters['newLink'] = false;
				if($parameters['flags'] == "") $parameters['flags'] = NULL;

				if($parameters['port'] == "" || $parameters['port'] == NULL){
					$this->connection = mysqli_connect(
						$parameters['server'],
						$parameters['username'],
						$parameters['password'],
						$parameters['newLink'],
						$parameters['flags']
					);
				}else{
					$this->connection = mysqli_connect(
						$parameters['server'].":".$parameters['port'],
						$parameters['username'],
						$parameters['password'],
						$parameters['newLink'],
						$parameters['flags']
					);
				}
				if($this->connection == FALSE)
					throw new marvel\core\Exception("Can not connect to mysql-server! Following error detected: ".$this->__error());
				else{
					if(!mysqli_select_db($this->connection, $parameters['database'])){
						throw new marvel\core\Exception("Can not select a database! Following error detected: ".$this->__error());
					}
				}
			}
		}
		protected function __isConnected(){
			if($this->connection != Null || $this->connection != FALSE){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		protected function __prepare($query){
			return $query;
		}
		protected function __query($query){
			$this->result = mysqli_query($query, $this->connection);
		}
		protected function __result(){
			return $this->result;
		}
		protected function __affectedRows(){

		}

		protected function __error(){
			$error = mysqli_error($this->connection)." ".mysqli_errno($this->connection);
			return $error;
		}
	}
}