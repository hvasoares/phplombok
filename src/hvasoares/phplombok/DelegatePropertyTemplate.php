<?php
namespace hvasoares\phplombok;
class DelegatePropertyTemplate {	
	public function generateSupportCode(){
		return
"public function setDelegateCallQueue(\$value){
	\$this->delegateCallQueue = \$value;
	\$this->delegateCallQueue->setReflectedObject(\$this->annotatedObject);
}
public function __call(\$method,\$args){
	try{
		if(method_exists(\$this,'magicMethod'))
			return \$this
				->magicMethod(\$method,\$args);
		return \$this->delegateCallQueue->call(\$method,\$args);
	}catch(\BadMethodCallException \$ex){
		return \$this->delegateCallQueue->call(\$method,\$args);
	}
}";		
	}
}
?>
