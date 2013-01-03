<?php
class Controller_home{
	public function indexAction(){
		print "Hello World";
		$a = new AssoziativArrayIterator(array(
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
		$a->eachValue(function($val1, $val2, $val3){
			echo "Val1: ".$val1." - Val2: ".$val2." - Val3: ".$val3;
			echo "<br />";
		});
		echo "<br />";
		$m = new Model_myModel();
	}
}
