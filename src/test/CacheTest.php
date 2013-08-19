<?php
namespace hvasoares\phplombok;
require_once 'Cache.php';
require_once __DIR__."/resources/TesteClass.php";
use hvasoares\phplombok\testresources as tr;
class CacheTest extends \PHPUnit_Framework_Testcase{
	public function testShouldCheckIfTheClassNotExists(){
		$obj = new tr\TestedClass();
		$inst = new Cache("/tmp",array());
		$randomReturn = rand();
		
		$this->assertFalse(
			$inst->classExists(get_class($obj))
		);

		$this->assertFalse(
			$inst->classExists(get_class($obj))
		);

		$this->newFile = $inst->generateAndLoadClassFile(
			get_class($obj),
			"<? function someTest(){return $randomReturn;};?>"
		);

		$this->assertRegExp(
			"/\/tmp\/\d+\.php/",
			$this->newFile
		);

		$this->assertEquals(
			$this->newFile,
			$inst->getFileForClass(get_class($obj))
		);

		$this->assertTrue(
			$inst->classExists(get_class($obj))
		);

		$this->assertEquals(\someTest(),$randomReturn);
	}

	public function tearDown(){
		$allFiles = array(
			$this->newFile
		);
		foreach($allFiles as $file)
			if(file_exists($file))
				unlink($file);
	}
}
?>
