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
        for ($i = 0; $i < 20; $i++) {
        $episode = new Episode();
        $episode->setTitle('Days Gone Bye');
        $episode->setSynopsis('Le shérif adjoint Rick Grimes se réveille d\'un coma et cherche sa famille 
        dans un monde ravagé par les morts-vivants');
        $episode->setNumber($i);
        $episode->setSeason($this->getReference('season_1'));
        $manager->persist($episode);
        }
        $manager->flush();

        for ($i = 0; $i < 20; $i++) {
        $episode2 = new Episode();
        $episode2->setTitle('Zoey\'s Extraordinary best friend');
        $episode2->setSynopsis('Zoey a essayé de comprendre comment contrôler ses nouvelles capacités tout en 
        naviguant sur les sentiments romantiques de sa meilleure amie pour elle et son premier jour en tant que chef d\'équipe;');
        $episode2->setNumber($i);
        $episode2->setSeason($this->getReference('season_1'));
        $manager->persist($episode2);
        }
        $manager->flush();

        for ($i = 0; $i < 20; $i++) {
        $episode3 = new Episode();
        $episode3->setTitle('Hell no');
        $episode3->setSynopsis('Jane est chargée d\'écrire un article sur le "meilleur orgasme" pour la rubrique sexe de Scarlet, 
        mais ne sait pas par où commencer puisqu\'elle n\'en a jamais eu auparavant.');
        $episode3->setNumber($i);
        $episode3->setSeason($this->getReference('season_1'));
        $manager->persist($episode3);
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
