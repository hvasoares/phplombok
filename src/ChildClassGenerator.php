<?php	
namespace hvasoares\phplombok;
class ChildClassGenerator{
	public function __construct($cache,$template,$factory){
		$this->c = $cache;
		$this->t = $template;
		$this->f = $factory;
	}
	public function generate($obj){
		$refObj = new \ReflectionObject($obj);
		$oldClassName = array_pop(
			explode("\\",$refObj->getName())
		);
		$newClassName = $oldClassName.time();
		if(!$this->c->classExists(get_class($obj))){
			$this->c->generateAndLoadClassFile(
				get_class($obj),
				$this->t->generateInheritedClass(
					$newClassName,
					$obj
				)
			);
			$this->f->configure(
				$refObj->getName(),
				$refObj->getNamespaceName()."\\"
					.$newClassName
			);
		}

		return $this->f->get($obj);	
	}

}
?>
