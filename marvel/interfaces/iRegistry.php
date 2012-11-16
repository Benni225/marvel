<?php
namespace marvel\interfaces{
	interface iRegistry{
		public static function add($name, $data, $dataHandler);
		public static function get($name);
		public static function update($name, $data);
	}
}