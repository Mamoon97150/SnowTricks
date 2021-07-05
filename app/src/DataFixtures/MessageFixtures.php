<?php


namespace App\DataFixtures;


use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        // OLLIE
        for ($i = 0; $i < 2; $i++){
            $messageOllieJohn = new Message();
            $messageOllieJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::OLLIE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageOllieJohn);
        }
        for ($i = 0; $i < 3; $i++){
            $messageOllieJane = new Message();
            $messageOllieJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::OLLIE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageOllieJane);

        }

        // AIR-TO-FAKIE
        for ($i = 0; $i < 2; $i++){
            $messageFakieJane = new Message();
            $messageFakieJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::FAKIE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageFakieJane);
        }
        for ($i = 0; $i < 3; $i++){
            $messageFakieJohn = new Message();
            $messageFakieJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::FAKIE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageFakieJohn);
        }

        // WHEELIE
        for ($i = 0; $i < 2; $i++){
            $messageWheelieJohn = new Message();
            $messageWheelieJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::WHEELIE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageWheelieJohn);
        }
        for ($i = 0; $i < 3; $i++){
            $messageWheelieJane = new Message();
            $messageWheelieJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::WHEELIE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageWheelieJane);
        }

        // BUTTERS
        for ($i = 0; $i < 2; $i++){
            $messageButtersJane = new Message();
            $messageButtersJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::BUTTER_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageButtersJane);
        }
        for ($i = 0; $i < 3; $i++){
            $messageButtersJohn = new Message();
            $messageButtersJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::BUTTER_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageButtersJohn);
        }

        // NOSE AN TAILS ROLLS
        for ($i = 0; $i < 2; $i++){
            $messageNoseJohn = new Message();
            $messageNoseJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::NOSE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageNoseJohn);
        }
        for ($i = 0; $i < 3; $i++){
            $messageNoseJane = new Message();
            $messageNoseJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::NOSE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageNoseJane);
        }

        // 50/50
        for ($i = 0; $i < 2; $i++){
            $messageFiftyJane = new Message();
            $messageFiftyJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::FIFTY_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageFiftyJane);
        }
        for ($i = 0; $i < 3; $i++){
            $messageFiftyJohn = new Message();
            $messageFiftyJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::FIFTY_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageFiftyJohn);
        }

        // 5-0
        for ($i = 0; $i < 2; $i++){
            $messageFiveJohn = new Message();
            $messageFiveJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::NOSEPRESS_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageFiveJohn);
        }
        for ($i = 0; $i < 3; $i++){
            $messageFiveJane = new Message();
            $messageFiveJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::NOSEPRESS_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageFiveJane);
        }

        // ROCK-N-ROLL
        for ($i = 0; $i < 2; $i++){
            $messageRockJane = new Message();
            $messageRockJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::BOARDSLIDE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageRockJane);
        }
        for ($i = 0; $i < 3; $i++){
            $messageRockJohn = new Message();
            $messageRockJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::BOARDSLIDE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageRockJohn);
        }

        // ALLEY OOPS
        for ($i = 0; $i < 2; $i++){
            $messageAlleyJohn = new Message();
            $messageAlleyJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::ALLEY_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageAlleyJohn);
        }
        for ($i = 0; $i < 3; $i++){
            $messageAlleyJane = new Message();
            $messageAlleyJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::ALLEY_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageAlleyJane);
        }

        // BACKSIDE 720
        for ($i = 0; $i < 2; $i++){
            $messageBacksideJane = new Message();
            $messageBacksideJane->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JANE))
                ->setTrick($this->getReference(TricksFixtures::BACKSIDE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageBacksideJane);
        }
        for ($i = 0; $i < 3; $i++){
            $messageBacksideJohn = new Message();
            $messageBacksideJohn->setContent($faker->text())
                ->setUser($this->getReference(UserFixtures::JOHN))
                ->setTrick($this->getReference(TricksFixtures::BACKSIDE_TRICK))
                ->setCreatedAt()
            ;
            $manager->persist($messageBacksideJohn);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            TricksFixtures::class
        ];
    }

}