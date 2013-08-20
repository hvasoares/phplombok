<?php
namespace hvasoares\phplombok;
class Cache{
	public function __construct($cacheDir,$lockFile){
		$this->dir = $cacheDir;
		$this->lockFile = $lockFile;
	}

	public function classExists($className){
		if(isset($this->lockFile[$className])){
			require_once $this->lockFile[$className];
			return true;
		}
		return false;
	} 
	public function generateAndLoadClassFile($className,$classContent){
		$newFile = $this->dir."/".time().".php";
		$this->writeToFile($newFile,$classContent);
		require_once $newFile;
		return	$this->lockFile[$className]=$newFile;
	}

	public function getFileForClass($className){
		if(!$this->classExists($className))
			throw new Exception("The $className isnt registered");
		return $this->lockFile[$className];
	}

	private function writeToFile($fileDir,$string){
		fwrite($file = fopen($fileDir,"w"),$string);
		fclose($file);
	}
}
?>
