<?php
namespace marvel\datahandler{
	class ArrayData implements \marvel\interfaces\iArrayData{
		private $data;
		public function get($name){
			if($this->data == NULL || !is_array($this->data)){
				return NULL;
			}else{
				if(array_key_exists($name, $this->data)){
					return $this->data[$name];
				}else{
					return NULL;
				}
			}
		}

		public function set(Array $data){
			$this->data = $data;
		}
	}
}