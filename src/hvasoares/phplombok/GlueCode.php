<?php
namespace hvasoares\phplombok;
use hvasoares\commons as c;
class GlueCode{
	public function getRegistry($registryWithConfig){
		$r = new c\Registry($registryWithConfig);
		$annotationStrategy= new PublicMethodOverrideTemplate(
			new AnnotationStrategyDoctrine(
				$r['phplombok_cachedir'],
				$supportCode = 	new SupportCodeChain(),
				$r['phplombok_debug']
			)
		);

		$lombokLock = new c\JsonPersistentArray($r['phplombok_cachedir']."/phplombok.lock".($r['phplombok_debug']? time():""));
		if(!isset($lombokLock['classCache']))
			$lombokLock['classCache'] = $r['phplombok_cachedir']."/classCache".time();

		if(!isset($lombokLock['cacheFile']))
			$lombokLock['cacheFile'] = $r['phplombok_cachedir']."/cacheFile".time();

		$builder = new Builder( new c\JsonPersistentArray(
			$lombokLock['classCache']
		));

		$builder->add(new PropertyAccessorConfig());
		$r['childClassGenerator']=new ChildClassGenerator(
			new Cache(
				$r['phplombok_cachedir'],
				new c\JsonPersistentArray($lombokLock['cacheFile'])
			),
			new Template($annotationStrategy),
			$builder
		);

		$supportCode->add(
			$jqAnnot =new JqueryProperty(),
			$accessorTemplate =new PropertyAccessorTemplate()
		);

		$annotationStrategy->setTemplateStrategy(
			$jqAnnot,
			new JQPropertyTemplateStrategy($accessorTemplate)
		);

		$annotationStrategy->setTemplateStrategy(
			$delAnnot = new Delegate(),
			$delConfig =new DelegateConfig($r)
		);

		$supportCode->add(
			$delAnnot,
			new DelegatePropertyTemplate()
		);

		$builder->add($delConfig);


		$r['delegateCallQueue'] = function($r){
			return new DelegateCallQueue();
		};


		
		$r['phplombok_annotationStrategy'] = $annotationStrategy;

		return $r;
	}
}
?>
