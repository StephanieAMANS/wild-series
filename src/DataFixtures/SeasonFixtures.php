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
        $season = new Season();
        $season->setDescription('Combat entre survivants et zombies');
        for ($i = 0; $i < 10; $i++) {
            $season->setNumber($i);
            $season->setYear(2010 + $i);
            $season->setProgram($this->getReference('program_1'));
            $manager->persist($season);
        }
        $this->addReference('season_1', $season);
        $manager->flush();

        $season2 = new Season();
        $season2->setDescription('Zoey et sa playlist');
        for ($i = 0; $i < 10; $i++) {
            $season2->setNumber($i);
            $season2->setYear(2020 + $i);
            $season2->setProgram($this->getReference('program_2'));
            $manager->persist($season2);
        }
        $this->addReference('season_2', $season);
        $manager->flush();

        $season3 = new Season();
        $season3->setDescription('Les filles chez Scarlett Magasine');
        for ($i = 0; $i < 10; $i++) {
            $season3->setNumber($i);
            $season3->setYear(2017 + $i);
            $season3->setProgram($this->getReference('program_3'));
            $manager->persist($season3);
        }
        $this->addReference('season3_', $season);
        $manager->flush();
    }

    public function getDependencies()
    {
        return  [
           ProgramFixtures::class
        ];
    }
}
