<?php
namespace hvasoares\phplombok;
class PublicMethodOverrideTemplate implements AnnotationStrategy{
	public function __construct($innerStrategy){
		$this->inner = $innerStrategy;
	}
	public function generateCode($newClassName,$obj){
		$result = $this->inner->generateCode(
			$newClassName,
			$obj
		)."\n";
		$ref = new \ReflectionObject($obj);
		foreach($ref->getMethods(\ReflectionMethod::IS_PUBLIC)
			as $method
		){
			$result .=
"public function {$method->getName()}(){
	return call_user_func_array(array(
			\$this->getAnnotatedObject(),
			'{$method->getName()}'
		),
		func_get_args()
	);
}";
		}
		return $result;
	}
	public function setTemplateStrategy($annotationObject,$strategy){
	
		$this->inner->setTemplateStrategy(
			$annotationObject,
			$strategy
		);
	} 
}
?>
