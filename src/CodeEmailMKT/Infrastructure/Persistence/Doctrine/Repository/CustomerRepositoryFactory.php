<?php

namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use CodeEmailMKT\Domain\Entity\Customer;

class CustomerRepositoryFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $entityManager = $container->get(EntityManager::class);
        return $entityManager->getRepository(Customer::class);
		
    }
	
	/*public function createService(ServiceLocatorInterface $serviceLocator){
		
        $entityManager = $serviceLocator->get(EntityManager::class);
        return $entityManager->getRepository(Customer::class);		
		
	}*/
}
