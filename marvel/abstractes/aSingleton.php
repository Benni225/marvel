<?php
namespace marvel\abstractes{
	use marvel\interfaces\iSingleton;
	/**
	 * Abstract singleton-class.
	 * @author Benjamin Werner
	 *
	 */
	abstract class aSingleton implements iSingleton{
		protected function __construct(){}
		protected function __clone(){}
	}
}