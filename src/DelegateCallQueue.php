<?php
namespace hvasoares\phplombok;
class DelegateCallQueue{
	public function addProperty($prop){
		$this->props[]=$prop;	
	}

	public function setReflectedObject($object){
		$this->refObj = new \ReflectionObject($object);	
		$this->obj = $object;
	}

	public function call($method,$args){
		$prop=$this->findProperty($method);
$methodName = lcfirst(
			str_replace($prop,"",$method)
		);
		$refP = $this->refObj->getProperty($prop);	
		$refP->setAccessible(true);

		return call_user_func_array(
			array(
				$refP->getValue($this->obj),
				$methodName
			),
			$args
		);
	}

	private function findProperty($methodName){
		foreach($this->props as $prop){
			if(strpos($methodName,$prop)===0)
				return $prop;
		}	
		throw new \BadMethodCallException();
	}
}
?>
