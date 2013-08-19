<?php
namespace hvasoares\phplombok;
require_once __DIR__."/AnnotationStrategy.php";
use \Doctrine\Common\Annotations as a;
class AnnotationStrategyDoctrine implements AnnotationStrategy{
	public function __construct($cacheDir,$propertyAccessorTemplate,$debug=false){
		$this->strategyDB = array();
		$this->reader= new a\FileCacheReader(new a\AnnotationReader(),$cacheDir,$debug);
		$this->registry = new a\AnnotationRegistry();
		$this->pat = $propertyAccessorTemplate;
	}
	public function generatecode($newClassName,$object){
		$refObj = new \ReflectionObject($object);
		$code = $this->pat->generateSupportCode();
		foreach($refObj->getProperties() as $p)
			$code .= $this->generateCodeProperty($p);

		return $code;
		
	}
	private function generateCodeProperty($p){
		$result = "";
		foreach($this->reader->getPropertyAnnotations($p) as	$annot){
			$key = get_class($annot);
			if(isset($this->strategyDb[$key])){
				$result .=$this->strategyDb[$key]->generate(
						$p->getName()
					);
			}
		}
		return $result;
	}
	public function setTemplateStrategy($annotObject,$templateStrategy){
		$refObj = new \ReflectionObject($annotObject);
		$this->strategyDb[$refObj->getName()] =$templateStrategy;
		$this->registry->registerFile($refObj->getFileName());
	}
}
?>
