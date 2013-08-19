<?php
 namespace hvasoares\phplombok;
class JQPropertyTemplateStrategy{
	public function __construct($valueAccessorTemplate){
		$this->vat= $valueAccessorTemplate;
	}
	public function generate($property){
		$valueSetting = $this->vat->generateSet(
			$property,"value"
		);
		$valueGetting = $this->vat->generateGet(
			$property,"result"
		);

		return (
"public function $property(\$value){
	if(\$value==null){
		$valueGetting
		return \$result;
	}
	$valueSetting
	return \$this;
}"
		);
	}
}
?>
