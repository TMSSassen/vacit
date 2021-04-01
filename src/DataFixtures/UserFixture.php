<?php
namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        \App\Factory\UserFactory::createMany(20);
        // $product = new Product();
        // $manager->persist($product);
        $manager->flush();
    }
}