<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program->setTitle('Walking Dead');
        $program->setSummary('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_0'));
        for ($i=0; $i < count(ActorFixtures::ACTOR); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }
        $manager->persist($program);
        $this->addReference('program_1', $program);
        $manager->flush();

        $program2 = new Program();
        $program2->setTitle('Zoey et son extraordinaire playlist');
        $program2->setSummary('Une jeune femme découvre qu\'elle a la capacité d\'entendre les pensées les plus 
        intimes des gens autour d\'elle sous forme de chansons');
        $program2->setCategory($this->getReference('category_1'));
        for ($i=0; $i < count(ActorFixtures::ACTOR); $i++) {
            $program2->addActor($this->getReference('actor_' . $i));
        }
        $manager->persist($program2);
        $this->addReference('program_2', $program2);


        $program3 = new Program();
        $program3->setTitle('The Bold Type');
        $program3->setSummary('Un aperçu de la vie et des relations amoureuses scandaleuses des employées d\'un 
        magasine féminin, inspiré de la vie de Joanna Coles, la rédactrice en chef de Cosmopolitan');
        $program3->setCategory($this->getReference('category_2'));
        for ($i=0; $i < count(ActorFixtures::ACTOR); $i++) {
            $program3->addActor($this->getReference('actor_' . $i));
        }
        $manager->persist($program3);
        $this->addReference('program_3', $program3);


        $program4 = new Program();
        $program4->setTitle('Sex and the City');
        $program4->setSummary('Quatre femmes new-yorkaises discute de leurs vies sexuelles et trouvent
        de nouvelles façons de faire face à la vie en tant que femme dans les années 90');
        $program4->setCategory($this->getReference('category_3'));
        for ($i=0; $i < count(ActorFixtures::ACTOR); $i++) {
            $program4->addActor($this->getReference('actor_' . $i));
        }
        $manager->persist($program4);
        $this->addReference('program_4', $program4);


        $program5 = new Program();
        $program5->setTitle('Sherlock');
        $program5->setSummary('Une version moderne du célèbre détective et de son partenaire médecin résolvant 
        le crime dans la ville de Londres au XXIème siècle');
        $program5->setCategory($this->getReference('category_4'));
        for ($i=0; $i < count(ActorFixtures::ACTOR); $i++) {
            $program5->addActor($this->getReference('actor_' . $i));
        }
        $manager->persist($program5);
        $this->addReference('program_5', $program5);
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            ActorFixtures::class,
            CategoryFixtures::class
        ];
    }
}
