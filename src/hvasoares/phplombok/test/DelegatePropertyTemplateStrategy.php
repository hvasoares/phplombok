<?php
namespace hvasoares\phplombok;
require_once 'DelegatePropertyTemplate.php';
use \Mockery as m;
class DelegatePropertyTemplateTest extends \PHPUnit_Framework_Testcase{
	public function testShouldDelegateMethodsToProperty(){
		$instance = new DelegatePropertyTemplate(
		);
		
		$dQueue =m::mock('delegateQueue');

		$this->assertEquals(
"public function setDelegateCallQueue(\$value){
	\$this->delegateCallQueue = \$value;
	\$this->delegateCallQueue->setReflectedObject(\$this->annotatedObject);
}
public function __call(\$method,\$args){
	try{
		if(method_exists(\$this,'magicMethod'))
			return \$this
				->magicMethod(\$method,\$args);
		return \$this->delegateCallQueue->call(\$method,\$args);
	}catch(\BadMethodCallException \$ex){
		return \$this->delegateCallQueue->call(\$method,\$args);
	}
}",		
			$instance->generateSupportCode()
		);		
			
	}	
}
?>
