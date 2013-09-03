<?php
namespace hvasoares\phplombok;
use \Mockery as m;
require_once 'SupportCodeChain.php';
class SupportCodeChainTest extends 
	\PHPUnit_Framework_Testcase{
	public function testShouldIterateThroughSupportCode(){
		$instance = new SupportCodeChain();
		
		$instance->add(new \stdClass,$sup1);

		$sup1 = m::mock('sup1');

		$sup1->shouldReceive(
			'generateSupportCode'
		)->andReturn('sup1 code');

		$instance->generateSupportCode();
	}	
}
?>
