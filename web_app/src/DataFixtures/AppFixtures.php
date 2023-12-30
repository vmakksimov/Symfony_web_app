<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i <= 5; $i++) {
            # code...
            $user = new User();


            $user->setName('name - Viktor' . $i);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
