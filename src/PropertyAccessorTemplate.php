<?php
namespace hvasoares\phplombok;
class PropertyAccessorTemplate {
	public function generateSupportMethods(){
		return (
"
public function setAnnotatedObject(\$object){
	\$this->annotatedObject = \$object;
	\$this->reflectedObject = new \ReflectionObject(\$object);
}
public function getReflectedProperty(\$property){
	\$prop = \$this->reflectedObject->getProperty(\$property);
	\$prop->setAcessible(true);
	return \$prop->getValue(\$this-annotatedObject);
}
public function setReflectedProperty(\$property,\$newValue){
	\$prop = \$this->reflectedObject->getProperty(\$property);
	\$prop->setAcessible(true);
	\$prop->setValue(\$this->annotatedObject,\$newValue);
}"
		);
	}

	public function generateGet($propertyName,$assignedVar){
		return "\$$assignedVar = \$this->getReflectedProperty('$propertyName');";
	}

	public function generateSet($propertyName,$variableName){
		return "\$this->setReflectedProperty('".
			"$propertyName',\$$variableName);";
	}
}?>
