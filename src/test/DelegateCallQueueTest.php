<?php
namespace hvasoares\phplombok;
require_once __DIR__."/resources/TestedClass3.php";
require_once "DelegateCallQueue.php";
use \Mockery as m;
class DelegateCallQueueTest extends \PHPUnit_Framework_Testcase{
	public function testShouldTryToCallPropertyMethods(){
		$testedObj = new testresources\TestedClass3();
		$testedObj->property1 = $obj =m::mock('someObj');

		$instance = new DelegateCallQueue();

		$instance->addProperty('property1');

		$instance->setReflectedObject($testedObj);

		$obj->shouldReceive('undefinedMethod')
			->with('arg1','arg2')
			->andReturn('someResult')
			->once();

		$this->assertEquals(
			$instance->call(
				'property1UndefinedMethod',
				array('arg1','arg2')
			),
			'someResult'
		);
	}
}
?>
