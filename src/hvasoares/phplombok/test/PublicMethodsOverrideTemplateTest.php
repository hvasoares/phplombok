<?php
namespace hvasoares\phplombok;
require_once 'PublicMethodOverrideTemplate.php';
use \Mockery as m;
class PublicMethodOverrideTemplateTest extends \PHPUnit_Framework_Testcase{
	public function testShouldOverrideOnlyPublicMethods(){
		$annotStrategy = m::mock('annotStra');
		$inst = new PublicMethodOverrideTemplate($annotStrategy);

		$obj = new testresources\TestedClass2();
		$annotStrategy->shouldReceive('generateCode')
			->with('newClassName',$obj)
			->andReturn('//someCode')
			->once();

		$this->assertEquals(
			$inst->generateCode('newClassName',$obj),
"//someCode
public function methodToBeOverriden(){
	return call_user_func_array(array(
			\$this->getAnnotatedObject(),
			'methodToBeOverriden'
		),
		func_get_args()
	);
}"
		);
	}
}
?>
