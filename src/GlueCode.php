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
		$r['childClassGenerator']=new ChildClassGenerator(
			new Cache(

				$r['phplombok_cachedir'],
				new JsonPersistentArray(
					$r['phplombok_generated_class_dir']
					."/".time().".json"
				)

			),
			new Template($annotationStrategy),
			new Factory()
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
