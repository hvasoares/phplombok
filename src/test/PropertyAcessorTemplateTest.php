<?php
namespace hvasoares\phplombok;
require_once 'PropertyAccessorTemplate.php';
use \Mockery as m;
class PropertyAccessorTemplateTest extends \PHPUnit_Framework_Testcase{
	public function setUp(){
		$this->inst = new PropertyAccessorTemplate();
	}
	public function testShouldGenerateSupportMethods(){
		$this->assertEquals(
"public function getReflectedProperty(\$property){
	\$prop = \$this->reflectedObject->getProperty(\$property);
	\$prop->setAccessible(true);
	return \$prop->getValue(\$this->annotatedObject);
}
public function setReflectedProperty(\$property,\$newValue){
	\$prop = \$this->reflectedObject->getProperty(\$property);
	\$prop->setAccessible(true);
	\$prop->setValue(\$this->annotatedObject,\$newValue);
}",
			$this->inst->generateSupportCode()
		);
	}

	public function testShouldGenerateCodeForGet(){
		$this->assertEquals(
			"\$result = \$this->getReflectedProperty('someProperty');",
			$this->inst->generateGet(
				'someProperty',
				'result'
			)

		);	
	}
	public function testShouldGenerateCodeForSet(){
		$this->assertEquals(
			"\$this->setReflectedProperty(".
			"'someProperty',\$variableWithNewValue);",
			$this->inst->generateSet(
				'someProperty',
				'variableWithNewValue'
			)
		);	
	}

}
?>
