<?php
namespace hvasoares\phplombok;
class Template{
	public function __construct($strategy){
		$this->s = $strategy;
	}
	public function generateInheritedClass($newClassName,$obj){
		$refObj = new \ReflectionObject($obj);
		$innerCode = $this->s->generateCode(
			$newClassName,
			$obj
		);
		$innerCode = str_replace("\n","\n\t",$innerCode);
		$className = array_pop(
			explode("\\",$refObj->getName())
		);
		$namespace = $refObj->getNamespaceName();

		return
"<?php
namespace $namespace;
class $newClassName extends $className{
	$innerCode	
}
?>";
	}
}
?>
