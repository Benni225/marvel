<?php
namespace marvel\datahandler{
	class PackageData implements \marvel\interfaces\iData{
		private $data = "";

		public function set($data){
			$this->data = $data;
		}

		public function get(){
			return $this->data;
		}

	}
}