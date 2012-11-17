<?php
namespace marvel\datahandler{
	use marvel\interfaces\iData;
	class PackageData implements iData{
		private $data = "";
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iData::set()
		 */
		public function set($data){
			$this->data = $data;
		}
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iData::get()
		 */
		public function get(){
			return $this->data;
		}

	}
}