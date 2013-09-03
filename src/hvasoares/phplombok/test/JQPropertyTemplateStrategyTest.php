<?php
namespace hvasoares\phplombok;
require_once 'JQPropertyTemplateStrategy.php';
use \Mockery as m;
class GetterTemplateStrategy extends \PHPUnit_Framework_Testcase{
	public function testShouldGenerateJQueryPropertyStyle(){
		$valueSetterTemplate = m::mock('valueSetter');

		$inst = new JQPropertyTemplateStrategy(
			$valueSetterTemplate
		);
		$valueSetterTemplate->shouldReceive('generateSet')
			->with('property','value')
			->andReturn(
				'//setting $value for property'
			)->once();
		$valueSetterTemplate->shouldReceive('generateGet')
			->with('property','result')
			->andReturn(
				'//getting $result for property'
			)->once();


		$this->assertEquals(
'public function property($value=null){
	if($value==null){
		//getting $result for property
		return $result;
	}
	//setting $value for property
	return $this;
}',

			$inst->generate('property')
		);
		
	}
}
