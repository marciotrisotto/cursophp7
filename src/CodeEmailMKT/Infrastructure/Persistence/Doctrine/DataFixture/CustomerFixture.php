<?php
namespace CodeEmailMKT\Infrastructure\Persistence\Doctrine\DataFixture;

use CodeEmailMKT\Domain\Entity\Customer;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as Faker;

class CustomerFixture implements FixtureInterface {
    
    public function load(ObjectManager $manager) {
        
        $faker = Faker::create();
        foreach (range(1,100) as $value) {
            $customer = new Customer();
            $customer->setName($faker->firstName . ' '. $faker->lastName)
                     ->setEmail($faker->email);
            $manager->persist($customer);            
        }
        $manager->flush();
    }
    
}
