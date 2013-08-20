<?php
namespace hvasoares\phplombok;
class PropertyAccessorTemplate {
	public function generateSupportCode(){
		return (
"
public function setAnnotatedObject(\$object){
	\$this->annotatedObject = \$object;
	\$this->reflectedObject = new \ReflectionObject(\$object);
}
public function getReflectedProperty(\$property){
	\$prop = \$this->reflectedObject->getProperty(\$property);
	\$prop->setAccessible(true);
	return \$prop->getValue(\$this->annotatedObject);
}
public function setReflectedProperty(\$property,\$newValue){
	\$prop = \$this->reflectedObject->getProperty(\$property);
	\$prop->setAccessible(true);
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
