<?php
namespace hvasoares\phplombok;
interface AnnotationStrategy{
	public function generateCode(
		$newClassName,
		$obj
	);
	public function setTemplateStrategy(
		$annotationObject,
		$templateStrategy
	);
}
?>
