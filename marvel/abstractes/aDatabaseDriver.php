<?php
namespace marvel\abstractes{
	abstract class aDatabaseDriver{
		protected $connection;
		abstract protected function __connect($parameters);
		abstract protected function __isConnected();
		abstract protected function __prepare();
		abstract protected function __query($query);
		abstract protected function __result();
		abstract protected function __affectedRows();

	}
}