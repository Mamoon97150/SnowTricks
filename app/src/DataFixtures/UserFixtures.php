<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;
    public const JANE = "jane doe";
    public const JOHN = 'john doe';

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        //user 1
        $jane = new User();
        $jane->setUsername("Jane2021")
            ->setLastName("Doe")
            ->setFirstName("Jane")
            ->setEmail('jane@test.com')
            ->setPicture('lee-chinyama-lU-PdecrqeE-unsplash.jpg')
            ->setIsVerified(true)
        ;

        $password = $this->hasher->hashPassword($jane, 'password1');
        $jane->setPassword($password);
        $manager->persist($jane);

        //user 2
        $john = new User();
        $john->setUsername("John2021")
            ->setLastName("Doe")
            ->setFirstName("John")
            ->setEmail('john@test.com')
            ->setPicture('abdulaziz-mohammed-ea-oFLGP7IU-unsplash.jpg')
            ->setIsVerified(true)
        ;

        $password = $this->hasher->hashPassword($john, 'password1');
        $john->setPassword($password);
        $manager->persist($john);

        $manager->flush();

        $this->addReference(self::JANE, $jane);
        $this->addReference(self::JOHN, $john);
    }
}
