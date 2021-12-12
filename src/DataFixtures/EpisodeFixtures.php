<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $episode = new Episode();
            $episode->setNumber($i);
            $episode->setTitle('Episode n°' . $i);
            $episode->setSynopsis('Le shérif adjoint Rick Grimes se réveille d\'un coma et cherche sa famille 
            dans un monde ravagé par les morts-vivants');
            $episode->setSeason($this->getReference('season_1' . $i));
            $manager->persist($episode);
        }


        for ($i = 0; $i < 10; $i++) {
            $episode = new Episode();
            $episode->setTitle('Episode n°' . $i);
            $episode->setSynopsis('Zoey a essayé de comprendre comment contrôler ses nouvelles capacités tout en 
            naviguant sur les sentiments romantiques de sa meilleure amie pour elle et son premier jour en tant que chef d\'équipe;');
            $episode->setNumber($i);
            $episode->setSeason($this->getReference('season_2' . $i));
            $manager->persist($episode);
        }

        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            SeasonFixtures::class
        ];
    }
}
