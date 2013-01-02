<?php
class MySqlQuerybuilder extends aQuerybuilder implements iQuerybuilder{
	private static $instance = NULL;
	public static function create(){
		if(self::$instance === NULL){
			self::$instance = new self;
		}
		return self::$instance;
	}
	public static function select(){
		$args = func_get_args();
		foreach ($args AS $value){
			$value = "`".$value."`";
		}
		return "SELECT ".implode(", ", $args);
	}

	public static function from(){
		$args = func_get_args();
		foreach ($args AS $value){
			$value = "`".$value."`";
		}
		return "FROM ".implode(", ", $args);
	}

	public static function delete(){
		return "DELETE";
	}

	public static function orderBy(){

	}

	public static function limit(){

	}

	public static function update(){

	}

	public static function where(){

	}
}
