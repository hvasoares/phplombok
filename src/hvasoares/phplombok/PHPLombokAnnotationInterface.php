<?php
namespace hvasoares\phplombok;
interface PHPLombokAnnotationInterface{
	public function isClassExclusive();
	public function isPropertyExclusive();
	public function setTemplate($value);
	public function getTemplate();
}
?>
