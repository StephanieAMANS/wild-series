<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $season = new Season();
            $season->setNumber($i);
            $season->setYear(2010 + $i);
            $season->setDescription('Combat entre survivants et zombies');
            $season->setProgram($this->getReference('program_1'));
            $this->addReference('season_1' . $i, $season);
            $manager->persist($season);
        }

        for ($i = 0; $i < 10; $i++) {
            $season2 = new Season();
            $season2->setNumber($i);
            $season2->setYear(2020 + $i);
            $season2->setDescription('Zoey et sa playlist');
            $season2->setProgram($this->getReference('program_2'));
            $this->addReference('season_2' . $i, $season2);
            $manager->persist($season2);
        }

        for ($i = 0; $i < 10; $i++) {
            $season3 = new Season();
            $season3->setNumber($i);
            $season3->setYear(2017 + $i);
            $season3->setDescription('Les filles chez Scarlett Magasine');
            $season3->setProgram($this->getReference('program_3'));
            $this->addReference('season3_' . $i, $season);
            $manager->persist($season3);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return  [
           ProgramFixtures::class
        ];
    }
}
