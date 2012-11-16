<?php
namespace marvel\abstractes{
	abstract class aSingleton implements \marvel\interfaces\iSingleton{
		protected static $instance = NULL;
		protected function __construct(){}
		protected function __clone(){}
	}
}