<?php
namespace app\controller{
	class myModel extends \marvel\core\Model{
		public $id = Array(
							'var'	=>	'integer',
							'type'	=>	'column'
						);
		public $realID = array(
			'type'	=>	'id',
			'var'	=>	'string'
		);


	}
}