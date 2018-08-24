<?php

namespace CodeEmailMKT\Application\Middleware;

use CodeEmailMKT\Infrastructure\Bootstrap;
use Interop\Container\ContainerInterface;
//use Zend\Expressive\Router\RouterInterface;
//use Zend\Expressive\Template\TemplateRendererInterface;

class BootstrapMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
 
		$bootstrap = new Bootstrap();
        return new BootstrapMiddleware($bootstrap);
    }
}