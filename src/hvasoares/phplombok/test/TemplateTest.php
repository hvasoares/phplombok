<?php
namespace hvasoares\phplombok;
require_once 'Template.php';
require_once __DIR__."/resources/TestedClass.php";
use \Mockery as m;
class TemplateTest extends \PHPUnit_Framework_Testcase{
	public function testShouldGenerateClassCode(){
		$strategy = m::mock('templateStrategy');
		$inst = new Template($strategy);	

		$obj = new testresources\TestedClass();

		$strategy->shouldReceive('generateCode')
			->with(
				"GeneratedClass",
				$obj
			)->andReturn("//someCode\n//otherCode")
			->once();
		$this->assertEquals(

		$inst->generateInheritedClass(
			'GeneratedClass',
			$obj
		),
"<?php
namespace hvasoares\\phplombok\\testresources;
class GeneratedClass extends TestedClass{
	public function setAnnotatedObject(\$object){
		\$this->annotatedObject = \$object;
		\$this->reflectedObject = new \ReflectionObject(\$object);
	}

	public function getAnnotatedObject(){
		return \$this->annotatedObject;
	}
	//someCode
	//otherCode	
}
?>"
		);
	}
}
?>
