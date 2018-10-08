<?php

namespace CodeEmailMKT\Infrastructure\Service;

use Interop\Container\ContainerInterface;

class FlashMessageFactory
{

    public function __invoke(ContainerInterface $container)
    {
		$session = $container->get(Session::class);
        return new FlashMessage($session);
		
    }
}
