<?php
namespace hvasoares\phplombok;
class Builder{
	private $nodes;
	private $classDb;

	public function __construct($classDb){
		$this->classDb = $classDb;
		$this->nodes = array();
	}

	public function add($node){
		$this->nodes[]=$node;
	}
	public function configure($fromClass,$toClass){
		$this->classDb[$fromClass] = $toClass;
	}

	public function get($obj){
		$newClass = $this->classDb[get_class($obj)];
		$newObject = new $newClass();
		$newObject->setAnnotatedObject($obj);
		foreach($this->nodes as $node)
			$newObject = $node->configure($obj,$newObject);
		return $newObject;
	}
}
?>
