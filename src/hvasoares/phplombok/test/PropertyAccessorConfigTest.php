<?php
namespace hvasoares\phplombok;
require_once 'PropertyAccessorConfig.php';
require_once __DIR__."/resources/SampleGeneratedClass.php";
use \Mockery as m;
class PropertyAccessorConfigTest extends \PHPUnit_Framework_Testcase{
	public function testShouldCallsetAnnotatedObject(){
		$inst = new PropertyAccessorConfig();	
		$generatedObj = new testresources\SampleGeneratedClass();
		$this->assertEquals(
			$inst->configure('someObject',$generatedObj)
			,$generatedObj
		);
		
		$this->assertEquals(
			"someObject",
			$generatedObj->innerObject
		);
	}
}
?>
