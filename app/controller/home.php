<?php
namespace app\controller{
	use marvel\Marvel;

	class home{
		public function homeInit(){
			print "Hello World";
			$a = new \marvel\iterators\AssoziativArrayIterator(array(
				0	=>	array(
					"key1"	=>	"value1",
					"key2"	=>	"value2",
					"key3"	=>	"value3"
				),
				1	=>	array(
					"key1"	=>	"value4",
					"key2"	=>	"value5",
					"key3"	=>	"value6"
				),
				2	=>	array(
					"key1"	=>	"value7",
					"key2"	=>	"value8",
					"key3"	=>	"value9"
				)
			));
			echo "<br />";
			$a->each(function($val1, $val2, $val3){
				echo "Val1: ".$val1." - Val2: ".$val2." - Val3: ".$val3;
				echo "<br />";
			});
		}
	}
}