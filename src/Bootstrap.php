<?php
require_once __DIR__."/../vendor/autoload.php";
$loader = new \Mockery\Loader;
$loader->register();


require_once __DIR__."/JQPropertyTemplateStrategy.php";
require_once __DIR__."/JqueryProperty.php";
require_once __DIR__."/AnnotationStrategyDoctrine.php";
require_once __DIR__."/AnnotationStrategy.php";
require_once __DIR__."/ChildClassGenerator.php";
require_once __DIR__."/Template.php";
require_once __DIR__."/PHPLombokAnnotationInterface.php";
require_once __DIR__."/PropertyAccessorTemplate.php";
require_once __DIR__."/Builder.php";
require_once __DIR__."/Cache.php";
require_once __DIR__."/PropertyAccessorConfig.php";
require_once __DIR__."/DelegateConfig.php";
require_once __DIR__."/Delegate.php";
require_once __DIR__."/DelegatePropertyTemplate.php";
require_once __DIR__."/DelegateCallQueue.php";
require_once __DIR__."/SupportCodeChain.php";
require_once __DIR__."/PublicMethodOverrideTemplate.php";
require_once __DIR__."/test/resources/TestedClass.php";
require_once __DIR__."/test/resources/TestedClass2.php";
require_once __DIR__."/test/resources/TestedClass3.php";
