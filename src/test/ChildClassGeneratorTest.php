<?php
namespace hvasoares\phplombok;
use \Mockery as m;
require_once "ChildClassGenerator.php";
use hvasoares\phplombok\testresources as tr;
class ChildClassGeneratorTest extends \PHPUnit_Framework_Testcase{
	public function testShouldGenerateClassGivenAnotherOne(){
		$obj = new tr\TestedClass;

		$inst = new ChildClassGenerator(
			$cache = m::mock('cache'),
			$template  = m::mock('classFillers'),
			$factory = m::mock('factory')
		);

		$cache->shouldReceive('classExists')
			->with(get_class($obj))
			->andReturn(false)
			->once();
		$cache->shouldReceive('generateAndLoadClassFile')
			->with(
				'hvasoares\phplombok\testresources\TestedClass',
				'someClassCode'
			)
			->once();


		$template->shouldReceive('generateInheritedClass')
			->with(
				'/TestedClass\\d+/',
				$obj
			)
			->andReturn(
				'someClassCode'
			)
			->once();

		$factory->shouldReceive('configure')
			->with(
				get_class($obj),
				"/".str_replace(
					"\\",
					"\\\\",
					get_class($obj)
				)."\\d+/"
			)
			->once();

		$factory->shouldReceive('get')
			->with($obj)
			->andReturn(new tr\TestedClass())
			->once();


		$anotherObject = $inst->generate($obj);

		$this->assertTrue($anotherObject instanceOf
			tr\TestedClass
		);
	}
}
?>
