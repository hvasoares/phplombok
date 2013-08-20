<?php
namespace hvasoares\phplombok;
use \hvasoares\commons as c;
require_once 'GlueCode.php';
class JQueryPropertyAnnotationTest extends \PHPUnit_Framework_Testcase{
	public function testShouldGeneratePropertiesLikeJQuery(){
		echo "############################3oi###########################";
		$r = new c\Registry();
		$r['phplombok_debug']=true;
		$r['phplombok_cachedir']="/tmp/";

		$glueCode = new GlueCode();
		$phplombokR = $glueCode->getRegistry($r);

		$glueCode1 = new GlueCode();
		$phplombokR1 = $glueCode1->getRegistry($r);


		$obj = new testresources\TestedClass2();

		$newObj= $phplombokR['childClassGenerator']
			->generate($obj);
	
		$newObj1= $phplombokR1['childClassGenerator']
			->generate($obj);


		$this->assertTrue(
			$newObj instanceOf testresources\TestedClass2
		);

		$this->assertEquals(
			get_class($newObj),
			get_class($newObj1)
		);

		$newObj->testedProperty1(1)
			->testedProperty2(2);

		$refObj = new \ReflectionObject($obj);
		$prop1 =$refObj->getProperty('testedProperty1');
		$prop1->setAccessible(true);

		$this->assertEquals(
			$prop1->getValue($obj),
			$newObj->testedProperty2(1)
				->testedProperty1()
		);

	}
	public function tearDown(){
		$json = new JsonPersistentArray("/tmp/phplombok.lock");
		$jsonCache = new JsonPersistentArray($json['cacheFile']);


		$obj = new testresources\TestedClass2();
		unlink($jsonCache[get_class($obj)]);

		unlink($json['cacheFile']);
		unlink($json['classCache']);
		unlink("/tmp/phplombok.lock");
	}
}
?>
