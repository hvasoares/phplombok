<?php
namespace hvasoares\phplombok;
class DelegateConfig{
	private $propertyBuffer;
	public function __construct($registry){
		$this->r = $registry;
		$this->propertyBuffer = array();	
	}
	public function generate($property){
		$this->propertyBuffer[]=$property;
	}
	public function configure($oldObj,$newObject){
		$delegateQueue = $this->r['delegateCallQueue'];
		foreach($this->propertyBuffer as $prop){
			$delegateQueue->addProperty($prop);	
		}
		$this->propertyBuffer = array();	
		$newObject->setDelegateCallQueue($delegateQueue);
		$newObject->setAnnotatedObject($oldObj);
		return $newObject;
	}
}
?>
