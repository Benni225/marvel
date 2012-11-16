<?php
namespace marvel\interfaces{
	interface iArrayData{
		public function get($name);
		public function set(Array $data);
	}
}