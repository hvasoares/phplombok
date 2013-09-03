<?php
namespace hvasoares\phplombok;
use \Mockery as m;
require_once 'DelegateConfig.php';
class DelegateConfigTest extends \PHPUnit_Framework_Testcase{
	public function testShouldConfigureADelegateObject(){
		$r = m::mock('\ArrayAccess');
		$instance = new DelegateConfig($r);

		$r->shouldReceive('offsetGet')
			->with('delegateCallQueue')
			->andReturn(
				$callMock1 = m::mock('callQueue1')
			)->times(2);

		$instance->generate('prop1');
		$newObject1 = m::mock('generatedObj1');
		$newObject1->shouldReceive(
			'setDelegateCallQueue'
		)->with($callMock1)
		->once();
		$newObject1->shouldReceive(
			'setAnnotatedObject'
		)->with('oldObj')
		->once();


		$callMock1->shouldReceive('addProperty')
			->with("prop1")
			->once();

		$instance->configure('oldObj',$newObject1);

		$newObject2 = m::mock('generateObj2');
		$instance->generate('prop2');

		$newObject2->shouldReceive(
			'setDelegateCallQueue'
		)->with($callMock1)
		->once();
		$newObject2->shouldReceive(
			'setAnnotatedObject'
		)->with('oldObj')
		->once();


		$callMock1->shouldReceive('addProperty')
			->with("prop2")
			->once();
		$this->assertEquals(
			$instance->configure('oldObj',$newObject2),
			$newObject2
		);
	}
}
?>
