<?php
namespace marvel{
	defined("__Basedir") or define("__Basedir", dirname($_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'])."/");
	class Marvel{
		/**
		 * Autoloader
		 * @author Benjamin Werner
		 * @param String $classname
		 */
		public static function	autoload($classname){
			$file = str_replace("\\", "/", $classname).'.php';
			if(file_exists(__Basedir.$file) == TRUE){
				require_once __Basedir.$file;
				return;
			}elseif(file_exists(__Basedir.__NAMESPACE__.'/'.$file) == TRUE){
				require_once __Basedir.__NAMESPACE__.'/'.$file;
				return;
			}else{
				$exception = new \marvel\core\Exception("Class ".$classname." not found");
			}
		}
	}
	\spl_autoload_register(array('marvel\Marvel', 'autoload'));
}