<?php

namespace CodeEmailMKT\Action;

use CodeEmailMKT\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;
//use Zend\Expressive\Router\RouterInterface;
//use Zend\Expressive\Template\TemplateRendererInterface;

class BootstrapActionFactory
{
    public function __invoke(ContainerInterface $container)
    {

		$bootstrap = new Bootstrap();
        return new BootstrapAction($bootstrap);
    }
}