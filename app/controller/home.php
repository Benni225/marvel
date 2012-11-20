<?php
namespace app\controller{
	use marvel\Marvel;

	class home{
		public function homeInit(){
			print "Hello World";
			$db = \marvel\database\mysql\database::create()->connect(array(
				'server'	=>	'localhost',
				'username'		=>	'root',
				'password'	=>	'',
				'database'	=>	'marvel'
			));
		}
	}
}