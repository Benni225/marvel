<?php
namespace marvel{
	use marvel\core\DataRegistry;
	use marvel\package\Package;
	use marvel\core\Exception;
	class Console{
		public function __construct(){
			Package::addPackage("$", "marvel\\Console");
			Package::addPackage("Package", "marvel\\package\\Package");
		}
		public static function run($command){
			$commandParts = explode(" ", $command);
			$packageName = $commandParts[0];
			$packageCommand = $commandParts[1];

			if(Package::checkPackage($packageName)){
				$package = Package::get($packageName);
				$packageClass = new \ReflectionClass($package);
				if($packageClass->hasMethod($packageCommand)){
					$packageMethod = $packageClass->getMethod($packageCommand);
					if($packageMethod->isPublic()){
						$rawArguments = array();
						for($p = 2; $p<count($commandParts); $p++){
							$rawArguments[] = $commandParts[$p];
						}
						$arguments = self::getParameters($rawArguments, $packageClass);
						if(!$packageClass->isInstantiable()){
							if($packageClass->isSubclassOf("\\marvel\\abstractes\\aSingleton")){
								return $packageMethod->invokeArgs($package::create(), $arguments);
							}else{
								throw new Exception("Package ".$packageName." is not callable!");
								die();
							}
						}else{
							return $packageMethod->invokeArgs(new $package, $arguments);
						}
					}else{
						throw new Exception("Command ".$packageCommand." in ".$packageName." is not callable!");
					}
				}else{
					throw new Exception("Command ".$packageCommand." is undefined in ".$packageName."!");
				}
			}else{
				throw new Exception("Package ".$packageName." undefined!");
				die();
			}
		}

		private static function getParameters($parameterParts, \ReflectionClass $packageClass){
			$arguments = Array();
			for($i = 0; $i < count($parameterParts); $i++){
				switch($parameterParts[$i]){
					//Is an package internal property
					case "-i":
						if($packageClass->hasProperty($parameterParts[$i+1])){
							$arguments[] = $packageClass->getProperty($parameterParts[$i+1])->getValue();
							$i++;
						}else{
							throw new Exception("Internal property ".$parameterParts[$i+1]." does not exist!");
							die();
						}
						break;
					//Is a value in the registry
					case "-r":
						$value = DataRegistry::get($parameterParts[$i+1]);
						if($value !== NULL){
							$arguments[] = $value;
							$i++;
						}else{
							throw new Exception("Registered value ".$parameterParts[$i+1]." does not exist!");
							die();
						}
						break;
					//Is a value from $_POST
					case "-p":
						$p = DataRegistry::get("POST");
						if(array_key_exists($parameterParts[$i+1], $p)){
							$arguments[] = $p[$parameterParts[$i+1]];
							$i++;
						}else{
							throw new Exception("POST value ".$parameterParts[$i+1]." does not exist!");
							die();
						}
						break;
					//Is a value from $_GET
					case "-g":
						$g = DataRegistry::get("GET");
						if(array_key_exists($parameterParts[$i+1], $g)){
							$arguments[] = $g[$parameterParts[$i+1]];
							$i++;
						}else{
							throw new Exception("GET value ".$parameterParts[$i+1]." does not exist!");
							die();
						}
						break;
					//Is a text. -# This is a text! #-
					case "-#":
						for($_i = $i+1; $_i<count($parameterParts); $_i++){
							if($parameterParts[$_i] != "#-"){
								$value.= $parameterParts[$_i];
							}else{
								$i = $_i;
								break;
							}
						}
						$value = self::escape($value);
						$arguments[] = $value;
						break;
					//Is a single value.
					default:
						$arguments[] = $parameterParts[$i];
						break;
				}
			}
			return $arguments;
		}

		private static function escape($value){
			$value = str_replace("<?", "", $value);
			$value = str_replace("<?php", "", $value);
			$value = str_replace("?>", "", $value);
			return $value;
		}

		public function addPackage($name, $class){
			Package::addPackage($name, $class);
			return "Package ".$name." added.";
		}
	}
}