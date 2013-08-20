<?php
namespace hvasoares\phplombok;
class PropertyAccessorConfig{
	public function configure($oldObject,$newObject){
		try{
			$refObj = new \ReflectionObject($newObject);
			$refObj->getMethod('setAnnotatedObject');
			$newObject->setAnnotatedObject($oldObject);
		}catch(\ReflectionException $ex){

		}
		return $newObject;
	}
}?>
