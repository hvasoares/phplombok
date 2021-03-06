<?php
namespace hvasoares\phplombok;
require_once 'AnnotationStrategyDoctrine.php';
require_once __DIR__.'/resources/SampleAnnotation.php';
require_once __DIR__.'/resources/TestedClass.php';
use \Mockery as m;
class AnnotationStrategyDoctrineTest extends \PHPUnit_Framework_Testcase{
	public function testShouldCodeGivenTheAnnotatedProperty(){
		$testObject = new testresources\TestedClass();

		$inst = new AnnotationStrategyDoctrine(
			"/tmp/",
			$supportCode = m::mock('accessorTmpl'),
			$debug = true
		);

		$inst->setTemplateStrategy(
			new testresources\SampleAnnotation(),
			$strategy = m::mock('templateS')
		);


		$supportCode->shouldReceive(
			'generateSupportCode'
		)->with(m::type('hvasoares\phplombok\testresources\SampleAnnotation'))
		->andReturn("//support methods")
		->once();

		$strategy->shouldReceive('generate')
			->with('annotatedProperty1')
			->andReturn("//code for annotatedProperty1")
			->once();

		$strategy->shouldReceive('generate')
			->with('annotatedProperty2')
			->andReturn("//code for annotatedProperty2")
			->once();

		$result =$inst->generateCode("someNewClass",$testObject);	
		$this->assertEquals(
			$result,
			"//code for annotatedProperty1"
			."//code for annotatedProperty2"
			."//support methods"
		);
	}
}
?>
