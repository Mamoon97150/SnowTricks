<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //user 1
        $jane = new User();
        $jane->setUsername("Jane2021")
            ->setLastName("Doe")
            ->setFirstName("Jane")
            ->setEmail('jane@test.com')
        ;

        $password = $this->encoder->encodePassword($jane, 'password1');
        $jane->setPassword($password);
        $manager->persist($jane);

        //user 2
        $john = new User();
        $john->setUsername("John2021")
            ->setLastName("Doe")
            ->setFirstName("John")
            ->setEmail('john@test.com')
        ;

        $password = $this->encoder->encodePassword($john, 'password1');
        $john->setPassword($password);
        $manager->persist($john);

        $manager->flush();
    }
}
