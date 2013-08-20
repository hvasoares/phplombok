<?php
namespace hvasoares\phplombok;
use hvasoares\commons as c;
class GlueCode{
	public function getRegistry($registryWithConfig){
		$r = new c\Registry($registryWithConfig);
		$annotationStrategy=	new AnnotationStrategyDoctrine(
				$r['phplombok_cachedir'],
				$accessorTemplate = 	new PropertyAccessorTemplate(),
				$r['phplombok_debug']
		);

		$lombokLock = new JsonPersistentArray($r['phplombok_cachedir']."/phplombok.lock");
		if(!isset($lombokLock['classCache']))
			$lombokLock['classCache'] = $r['phplombok_cachedir']."/classCache".time();

		if(!isset($lombokLock['cacheFile']))
			$lombokLock['cacheFile'] = $r['phplombok_cachedir']."/cacheFile".time();

		$builder = new Builder( new JsonPersistentArray(
			$lombokLock['classCache']
		));

		$builder->add(new PropertyAccessorConfig());
		$r['childClassGenerator']=new ChildClassGenerator(
			new Cache(
				$r['phplombok_cachedir'],
				new JsonPersistentArray($lombokLock['cacheFile'])
			),
			new Template($annotationStrategy),
			$builder
		);

		$annotationStrategy->setTemplateStrategy(
			new JQueryProperty(),
			new JQPropertyTemplateStrategy($accessorTemplate)
		);

		
		$r['phplombok_annotationStrategy'] = $annotationStrategy;

		return $r;
	}
}
?>
