<?php

namespace App\DataFixtures;

use App\Entity\Searches;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $words = [
            "i","try","to","start","learning","symfony",
            "life","stay","at","home","going","see"
        ];

        foreach ($words as $word) {
            $searches = new Searches();
            $searches->setWord($word);
            $searches->setSearches(mt_rand(10, 100));
            $manager->persist($searches);
        }

        $manager->flush();
    }
}
