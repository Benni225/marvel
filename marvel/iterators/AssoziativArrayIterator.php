<?php
namespace marvel\iterators{
	use \marvel\interfaces\iIterator, \marvel\abstractes\aIterator;

	class AssoziativArrayIterator extends aIterator implements iIterator{
		/**
		 *
		 * Is the stack. It filled with the current array of the ressource.
		 * @var array
		 */
		private $__current = array();
		/**
		 *
		 * Internal counter
		 * @var integer
		 */
		private $__counter;
		/**
		 * @param array $ressource
		 */
		public function __construct(Array $ressource){
			$this->ressource = $ressource;
			$this->first();
		}
		/**
		 * Gets a specified value of the stack.
		 * @param string $name
		 */
		public function __get($name){
			if(key_exists((string)$name, $this->__current)){
				return $this->__current[(string)$name];
			}else{
				throw \marvel\core\Exception("Property does not exist.");
				return NULL;
			}
		}
		/**
		 * Sets a value of the stack.
		 * @param string $name
		 * @param mixed $value
		 */
		public function __set($name, $value){
			$this->__current[(string)$name] = $value;
		}
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iIterator::first()
		 */
		public function first(){
			if(count($this->ressource) > 0){
				$this->save();
				$this->__counter = 0;
				reset($this->ressource);
				$this->fillCurrent();
			}
			return $this;
		}
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iIterator::next()
		 */
		public function next(){
			if(count($this->ressource) > 0){
				$this->save();
				$this->__counter++;
				next($this->ressource);
				$this->fillCurrent();
			}
			return $this;
		}
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iIterator::previous()
		 */
		public function previous(){
			if(count($this->ressource) > 0){
				$this->save();
				$this->__counter--;
				prev($this->ressource);
				$this->fillCurrent();
			}
			return $this;
		}
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iIterator::last()
		 */
		public function last(){
			if(count($this->ressource) > 0){
				$this->save();
				$this->__counter = count($this->ressource)-1;
				end($this->ressource);
				$this->fillCurrent();
			}
			return $this;
		}
		/**
		 *
		 * Returns the current array of the ressource.
		 */
		public function get(){
			return current($this->ressource);
		}
		/**
		 * (non-PHPdoc)
		 * @see marvel\interfaces.iIterator::isLast()
		 */
		public function isLast(){
			if(count($this->ressource) > 0){
				if(next($this->ressource) == false){
					return true;
				}else{
					prev($this->ressource);
					return false;
				}
			}else{
				return true;
            }
		}
		/**
		 *
		 * Saves the stack to the current array.
		 */
		public function save(){
			if(!empty($this->__current)){
				$array = current($this->ressource);
				foreach($this->__current AS $key=>$value){
					$this->ressource[$this->__counter][$key] = $value;
				}
			}
		}
		/**
		 *
		 * Returns the ressource.
		 */
		public function getRessource(){
			return $this->ressource;
		}
		/**
		 *
		 * Fills the stack with the current array.
		 */
		protected function fillCurrent(){
			foreach(current($this->ressource) AS $key=>$value){
				$this->__current[$key] = $value;
			}
		}
		/**
		 * Runs a callbackfunction on every array or arrays item of the ressource.
		 * The callback-function gets the current array as an
		 * array itself, or as the items of the array. In this case the number of
		 * parameters of the callback-function has to be equal to the
		 * number of ressourceitems.
		 * <code>
		 *	$a = new \marvel\iterators\AssoziativArrayIterator(array(
		 *		0	=>	array(
		 *			"key1"	=>	"value1",
		 *			"key2"	=>	"value2",
		 * 			"key3"	=>	"value3"
		 *		),
		 *		1	=>	array(
		 *			"key1"	=>	"value4",
		 *			"key2"	=>	"value5",
		 *			"key3"	=>	"value6"
		 *		),
		 *		2	=>	array(
		 *			"key1"	=>	"value7",
		 *			"key2"	=>	"value8",
		 *			"key3"	=>	"value9"
		 *		)
		 *	));
		 *	$a->each(function($val1, $val2, $val3){
		 *		echo "Val1: ".$val1." - Val2: ".$val2." - Val3: ".$val3;
		 *		echo "<br />";
		 *	});
		 *	echo "<br />";
		 *	$a->each(function($array){
		 *		var_dump($array);
		 *		echo "<br />";
		 *	});
		 * </code>
		 * @param function $callback
		 */
		public function each($callback){
			$rFunction = new \ReflectionFunction($callback);
			$numberOfParameters = $rFunction->getNumberOfParameters();
			foreach($this->ressource AS $value){
				if($numberOfParameters == 1)
					call_user_func($callback, $value);
				else
					call_user_func_array($callback, $value);
			}
		}
	}
}