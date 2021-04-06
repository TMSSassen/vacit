<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use \App\Factory\UserFactory;
use \App\Factory\SolicitatieFactory;
use App\Factory\VacatureFactory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $platforms=$this->createPlatforms($manager);
        // $product = new Product();
        // $manager->persist($product);
        UserFactory::createMany(20);
        VacatureFactory::createMany(20, function() use (&$faker,&$platforms){
            return [
                'bedrijf' => UserFactory::random(),
                'platform'=>$faker->randomElement($platforms)
            ];
        });

        SolicitatieFactory::createMany(50, function() {
            return [
                'user' => UserFactory::random(),
                'vacature' => VacatureFactory::random()
            ];
        });

        $manager->flush();
    }

    private function createPlatforms(ObjectManager $manager) {
        $platforms=['php','linux','windows','java'];
        $entries=[];
        foreach($platforms as $naamPlatform)
        {
            $platform=new \App\Entity\Platform();
            $platform->setNaam($naamPlatform);
            $platform->setLogo($naamPlatform);
            $manager->persist($platform);
            $entries[]=$platform;
        }
        return $entries;
    }

}
