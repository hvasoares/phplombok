<?php
namespace hvasoares\phplombok;
class SupportCodeChain{
	private $chain;
	public function __construct(){
		$this->chain = array();
	}
	public function add($annot,$supportCode){
		$this->chain[get_class($annot)]=$supportCode;
	}

	public function generateSupportCode($annot){
		return $this->chain[get_class($annot)]
			->generateSupportCode();
	}
}
?>
