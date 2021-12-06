<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public const ACTOR = [
        'Norman Reedus',
        'Andrew Lincoln',
        'Lauren Cohan',
        'Jeffrey Dean Morgan',
        'Chandler Riggs',
    ];
    public function load(ObjectManager $manager): void
    {
        foreach(self::ACTOR as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $this->addReference('actor_' . $key, $actor);
            $manager->persist($actor);
        }
        $manager->flush();
    }
}
