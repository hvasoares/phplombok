<?php
namespace hvasoares\phplombok;
use \hvasoares\commons as c;
require_once 'GlueCode.php';
class JQueryPropertyAnnotationTest extends \PHPUnit_Framework_Testcase{
	public function testShouldGeneratePropertiesLikeJQuery(){
		$r = new c\Registry();
		$r['phplombok_debug']=true;
		$r['phplombok_cachedir']="/tmp";
		$r['phplombok_generated_class_dir']="/tmp";

		$glueCode = new GlueCode();
		$phplombokR = $glueCode->getRegistry($r);
	}
}
?>
