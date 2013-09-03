<?php
namespace hvasoares\phplombok;
use \hvasoares\commons as c;
use \Mockery as m;
require_once 'GlueCode.php';
require_once __DIR__."/resources/TestedClass3.php";
class DelegateAnnotationTest extends \PHPUnit_Framework_Testcase{
	public function testShouldDelegateUndefinedMethodsToAnnotatedProperty(){
		$r = new c\Registry();
		$r['phplombok_debug']=true;
		$r['phplombok_cachedir']="/tmp/";

		$glueCode = new GlueCode();
		$phplombokR = $glueCode->getRegistry($r);

		$obj = new testresources\TestedClass3();
		$obj->property1 = $prop1 = m::mock('delegateObj');

		$newObj = $phplombokR['childClassGenerator']
			->generate($obj);

		$prop1->shouldReceive('undefinedMethod')
			->with('arg1')
			->andReturn('someResult')
			->once();
		$this->assertEquals(
			$newObj->property1UndefinedMethod('arg1'),
			'someResult'
		);

	}
}
?>
