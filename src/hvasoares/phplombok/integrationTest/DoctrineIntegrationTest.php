<?php
require_once __DIR__."/resource/AnnotationSample.php";
require_once __DIR__."/resource/AnnotatedClass.php";
use \Doctrine\Common\Annotations as a;
class DoctrineAnnotationIntegrationTest extends PHPUnit_Framework_Testcase{
	public function testGivenAnObjectShouldProcessIt(){
		a\AnnotationRegistry::registerFile(
			 __DIR__."/resource/AnnotationSample.php"
		 );

		$someObj = new AnnotatedClass();

		$reader = new a\AnnotationReader(
			"/tmp/",
			$debug = true
		);

		$classAnnots = $reader->getClassAnnotations(
			new ReflectionObject($someObj)
		);

		$this->assertNotEmpty($classAnnots);

		$this->assertEquals(
			$classAnnots[0]->property,
			"some"
		);
	}
}
?>
