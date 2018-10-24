<?php

namespace CodeEmailMKT\Application\Action\Customer\Factory;

use CodeEmailMKT\Application\Action\Customer\CustomerListPageAction;
//use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use CodeEmailMKT\Domain\Persistence\CustomerRepositoryInterface;

class CustomerListPageFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $template = $container->get(TemplateRendererInterface::class);
        $repository = $container->get(CustomerRepositoryInterface::class);
        //$entityManager = $container->get(EntityManager::class);
        return new CustomerListPageAction($repository,$template);
    }
}