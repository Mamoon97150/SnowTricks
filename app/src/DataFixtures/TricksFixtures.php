<?php

namespace App\DataFixtures;

use App\Entity\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TricksFixtures extends Fixture implements DependentFixtureInterface
{
    public const OLLIE_TRICK = 1;
    public const FAKIE_TRICK = 2;
    public const WHEELIE_TRICK = 3;
    public const BUTTER_TRICK = 4;
    public const NOSE_TRICK = 5;
    public const FIFTY_TRICK = 6;
    public const FIVE_TRICK = 7;
    public const ROCK_TRICK = 8;
    public const ALLEY_TRICK = 9;
    public const BACKSIDE_TRICK = 10;


    public function load(ObjectManager $manager)
    {
        // trick 1 : Ollies
        $ollies = new Tricks();
        $ollies->setName('Ollies')
            ->setDescription('A trick in which the snowboarder springs off the tail of the board and into the air.')
            ->setGroup($this->getReference(GroupFixtures::AERIAL_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($ollies);

        // trick 2 : Air to Fakie
        $airToFakie = new Tricks();
        $airToFakie->setName('Air-to-fakie')
            ->setDescription('This Aerial Trick involves making a 180-degree turn in the air and then riding switch.')
            ->setGroup($this->getReference(GroupFixtures::AERIAL_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($airToFakie);

        // trick 3 : Wheelies
        $wheelies = new Tricks();
        $wheelies->setName('Wheelies')
            ->setDescription('Learn how to maintain balance while riding just one end of your board by doing a Wheelie.')
            ->setGroup($this->getReference(GroupFixtures::SURFACE_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($wheelies);

        // trick 4 : Butters
        $butters = new Tricks();
        $butters->setName('Butters')
            ->setDescription('While traveling along the surface of the snow, this trick is performed by pressuring either the nose or tail of the snowboard in such a way that the opposite half of the snowboard lifts off of the snow, allowing for a pivot-like rotation.')
            ->setGroup($this->getReference(GroupFixtures::SURFACE_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($butters);

        // trick 5 : Nose and Tails
        $nose_tail = new Tricks();
        $nose_tail->setName('Nose and Tails Rolls')
            ->setDescription('A trick in which the snowboarder springs off the tail of the board and into theA Nose and Tail Roll is done by using either your board’s nose or tail to spin 180 degrees and thus changing your stance.')
            ->setGroup($this->getReference(GroupFixtures::SURFACE_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($nose_tail);

        // trick 6 : 50/50
        $fifty = new Tricks();
        $fifty->setName('50/50')
            ->setDescription('A Nose and Tail Roll is done by using either your board’s nose or tail to spin 180 degrees and thus changing your stance.')
            ->setGroup($this->getReference(GroupFixtures::RAILS_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($fifty);

        // trick 7 : Five-O
        $fiveO = new Tricks();
        $fiveO->setName('Five-0')
            ->setDescription('In this trick, you will make a Wheelie instead of just grinding with the board flat on the rail.')
            ->setGroup($this->getReference(GroupFixtures::RAILS_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($fiveO);

        // trick 8 : Rock-n-Roll
        $rock = new Tricks();
        $rock->setName('Rock-n-Roll')
            ->setDescription('In doing a Rock-n-Roll Grind, you need to keep the board parallel to the rail while grinding.')
            ->setGroup($this->getReference(GroupFixtures::RAILS_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($rock);

        // trick 9 : Alley Oops
        $alley = new Tricks();
        $alley->setName('Alley Oops')
            ->setDescription(' In this trick, you need to turn 180 degrees as you go uphill.')
            ->setGroup($this->getReference(GroupFixtures::HALF_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($alley);

        // trick 10 : Backside 720
        $backside = new Tricks();
        $backside->setName('Backside 720')
            ->setDescription('In this Snowboarding Trick, you need to make two full spins in the air.')
            ->setGroup($this->getReference(GroupFixtures::HALF_TRICKS_GROUP))
            ->setCreatedAt()
        ;
        $manager->persist($backside);

        $manager->flush();

        $this->addReference(self::OLLIE_TRICK, $ollies);
        $this->addReference(self::FAKIE_TRICK, $airToFakie);
        $this->addReference(self::WHEELIE_TRICK, $wheelies);
        $this->addReference(self::BUTTER_TRICK, $butters);
        $this->addReference(self::NOSE_TRICK, $nose_tail);
        $this->addReference(self::FIFTY_TRICK, $fifty);
        $this->addReference(self::FIVE_TRICK, $fiveO);
        $this->addReference(self::ROCK_TRICK, $rock);
        $this->addReference(self::ALLEY_TRICK, $alley);
        $this->addReference(self::BACKSIDE_TRICK, $backside);

    }

    public function getDependencies(): array
    {
        return [
          GroupFixtures::class
        ];
    }
}
