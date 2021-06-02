<?php


namespace App\DataFixtures;


use App\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{

    public const AERIAL_TRICKS_GROUP = "aerial";
    public const SURFACE_TRICKS_GROUP = "surface";
    public const RAILS_TRICKS_GROUP = "rails";
    public const HALF_TRICKS_GROUP = "halfpipe";

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        //group 1
        $aerial = new Group();
        $aerial->setName("aerial");
        $manager->persist($aerial);

        //group 2
        $surface= new Group();
        $surface->setName("surface");
        $manager->persist($surface);

        //Group 3
        $rails= new Group();
        $rails->setName('on rails');
        $manager->persist($rails);

        //Group 4
        $halfpipe= new Group();
        $halfpipe->setName('halfpipe');
        $manager->persist($halfpipe);

        $manager->flush();

        $this->addReference(self::AERIAL_TRICKS_GROUP, $aerial);
        $this->addReference(self::SURFACE_TRICKS_GROUP, $surface);
        $this->addReference(self::RAILS_TRICKS_GROUP, $rails);
        $this->addReference(self::HALF_TRICKS_GROUP, $halfpipe);
    }
}