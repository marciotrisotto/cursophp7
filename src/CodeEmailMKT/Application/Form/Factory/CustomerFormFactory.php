<?php

namespace CodeEmailMKT\Application\Form\Factory;

use CodeEmailMKT\Application\Action\Customer\CustomerListPageAction;
use Interop\Container\ContainerInterface;
use CodeEmailMKT\Application\Form\CustomerForm;
use Zend\Hydrator\ClassMethods;
use CodeEmailMKT\Domain\Entity\Customer;
use CodeEmailMKT\Application\InputFilter\CustomerInputFilter;

class CustomerFormFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $form = new CustomerForm();
        
        $form->setHydrator(new ClassMethods());
        $form->setObject(new Customer());
        $form->setInputFilter(new CustomerInputFilter());        
        return $form;
    }
}