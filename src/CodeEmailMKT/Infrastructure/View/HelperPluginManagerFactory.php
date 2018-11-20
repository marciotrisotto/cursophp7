<?php

namespace CodeEmailMKT\Infrastructure\View;

use Interop\Container\ContainerInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

class HelperPluginManagerFactory
{

    public function __invoke(ContainerInterface $container){
		
		$config = $container->get('config');
		$viewHelpers = $config['view_helpers'];
		//var_dump($viewHelpers);
		//echo $viewHelpers;		
		//exit;
		$manager = new HelperPluginManager($container,$viewHelpers);
		$phpRenderer = new PhpRenderer();
		$phpRenderer->setHelperPluginManager($manager);
		
		return $manager;
		
    }
}