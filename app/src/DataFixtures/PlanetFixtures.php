<?php

namespace App\DataFixtures;

use App\Entity\Planet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PlanetFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager): void
    {
        $this->faker = Factory::create();

        // create 20 products! Bam!
        for ($i = 1; $i <= 20; ++$i) {
            $planet = new Planet();
            $planet->setId($i);
            $planet->setName('planet ' . $i);
            $planet->setCreated($this->faker->dateTimeBetween('-100 days', '-1 days'));
            $planet->setEdited($this->faker->dateTimeBetween('-100 days', '-1 days'));
            $planet->setDiameter($this->faker->numberBetween(100000, 200000));
            $manager->persist($planet);
        }

        $manager->flush();
    }
}
