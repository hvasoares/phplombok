<?php
namespace hvasoares\phplombok;
require_once 'Builder.php';
require_once __DIR__."/resources/TestedClass.php";
require_once __DIR__."/resources/SampleGeneratedClass.php";
use \Mockery as m;
class BuilderTest extends \PHPUnit_Framework_Testcase{
	public function testShouldPassTheNewObjectThroughTheChain(){
		$inst = new Builder(array());
		$inst->add($node1 = m::mock('chainnode1'));
		$inst->add($node2 = m::mock('chainnode2'));

		$oldClass = 'hvasoares\phplombok\\'
			.'testresources\TestedClass';
		$newClass = 'hvasoares\phplombok\\'
			.'testresources\SampleGeneratedClass';

		$inst->configure($oldClass,$newClass);

		$obj = new testresources\TestedClass();

		$node1->shouldReceive('configure')
			->with($obj,m::type($newClass))
			->andReturn('modifiedBy node1')
			->once();
		$node2->shouldReceive('configure')
			->with($obj,'modifiedBy node1')
			->andReturn('modifiedBy node2')
			->once();

		$this->assertEquals(
			$inst->get($obj),
			"modifiedBy node2"
		);
	}	
}
?>
