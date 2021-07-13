<?php

namespace App\DataFixtures;

use App\Entity\Medias;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //OLLIES
        $ollie1 = new Medias();
        $ollie1->setName("ollie-1.jpeg")
            ->setTrick($this->getReference(TricksFixtures::OLLIE_TRICK))
            ->setFeatured(true)
            ->setExtension("jpeg");
        ;
        $manager->persist($ollie1);

        $ollie2 = new Medias();
        $ollie2->setName("ollie-2.jpeg")
            ->setTrick($this->getReference(TricksFixtures::OLLIE_TRICK))
            ->setFeatured(false)
            ->setExtension("jpeg");
        ;
        $manager->persist($ollie2);

        $ollie3 = new Medias();
        $ollie3->setName("How to Ollie on a Snowboard - Snowboarding Tricks.mp4")
            ->setTrick($this->getReference(TricksFixtures::OLLIE_TRICK))
            ->setFeatured(false)
            ->setExtension("mp4");
        ;
        $manager->persist($ollie3);

        //FAKIES
        $fakie1 = new Medias();
        $fakie1->setName("fakie1.jpeg")
            ->setTrick($this->getReference(TricksFixtures::FAKIE_TRICK))
            ->setFeatured(true)
            ->setExtension("jpeg");
        ;
        $manager->persist($fakie1);

        $fakie2 = new Medias();
        $fakie2->setName("fakie2.jpeg")
            ->setTrick($this->getReference(TricksFixtures::FAKIE_TRICK))
            ->setFeatured(false)
            ->setExtension("jpeg");
        ;
        $manager->persist($fakie2);

        $fakie3 = new Medias();
        $fakie3->setName('<iframe height="250" src="https://www.youtube.com/embed/2fP_R0tXFAc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
            ->setTrick($this->getReference(TricksFixtures::FAKIE_TRICK))
            ->setFeatured(false)
            ->setExtension("link");
        ;
        $manager->persist($fakie3);

        //WHEELIES
        $wheelie1 = new Medias();
        $wheelie1->setName("wheelie1.jpeg")
            ->setTrick($this->getReference(TricksFixtures::WHEELIE_TRICK))
            ->setFeatured(true)
            ->setExtension("jpeg");
        ;
        $manager->persist($wheelie1);

        $wheelie2 = new Medias();
        $wheelie2->setName("wheelie2.jpg")
            ->setTrick($this->getReference(TricksFixtures::WHEELIE_TRICK))
            ->setFeatured(false)
            ->setExtension("jpg");
        ;
        $manager->persist($wheelie2);

        $wheelie3 = new Medias();
        $wheelie3->setName('<iframe height="250" src="https://www.youtube.com/embed/AKC80-zYU1c" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
            ->setTrick($this->getReference(TricksFixtures::WHEELIE_TRICK))
            ->setFeatured(false)
            ->setExtension("link");
        ;
        $manager->persist($wheelie3);

        //BUTTERS
        $butter1 = new Medias();
        $butter1->setName("butter1.jpeg")
            ->setTrick($this->getReference(TricksFixtures::BUTTER_TRICK))
            ->setFeatured(true)
            ->setExtension("jpeg");
        ;
        $manager->persist($butter1);

        $butter2 = new Medias();
        $butter2->setName("butter2.jpeg")
            ->setTrick($this->getReference(TricksFixtures::BUTTER_TRICK))
            ->setFeatured(false)
            ->setExtension("jpeg");
        ;
        $manager->persist($butter2);

        $butter3 = new Medias();
        $butter3->setName('<iframe height="250" src="https://www.youtube.com/embed/cVKamPWu_Sc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
            ->setTrick($this->getReference(TricksFixtures::BUTTER_TRICK))
            ->setFeatured(false)
            ->setExtension("link");
        ;
        $manager->persist($butter3);

        //NOSE and TAILS ROLLS
        $nose1 = new Medias();
        $nose1->setName("nose1.jpeg")
            ->setTrick($this->getReference(TricksFixtures::NOSE_TRICK))
            ->setFeatured(true)
            ->setExtension("jpeg");
        ;
        $manager->persist($nose1);

        $nose2 = new Medias();
        $nose2->setName('<iframe height="250" src="https://www.youtube.com/embed/tfTp6wD4l4g" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
            ->setTrick($this->getReference(TricksFixtures::NOSE_TRICK))
            ->setFeatured(false)
            ->setExtension("link");
        ;
        $manager->persist($nose2);

        //50/50
        $fifty1 = new Medias();
        $fifty1->setName("5050_1.jpeg")
            ->setTrick($this->getReference(TricksFixtures::FIFTY_TRICK))
            ->setFeatured(true)
            ->setExtension("jpeg");
        ;
        $manager->persist($fifty1);

        $fifty2 = new Medias();
        $fifty2->setName("5050_2.jpeg")
            ->setTrick($this->getReference(TricksFixtures::FIFTY_TRICK))
            ->setFeatured(false)
            ->setExtension("jpeg");
        ;
        $manager->persist($fifty2);

        $fifty3 = new Medias();
        $fifty3->setName('<iframe height="250" src="https://www.youtube.com/embed/YD4LRu9I84I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
            ->setTrick($this->getReference(TricksFixtures::FIFTY_TRICK))
            ->setFeatured(false)
            ->setExtension("link");
        ;
        $manager->persist($fifty3);

        //NOSE PRESS
        $press1 = new Medias();
        $press1->setName("nosepress1.jpeg")
            ->setTrick($this->getReference(TricksFixtures::NOSEPRESS_TRICK))
            ->setFeatured(true)
            ->setExtension("jpeg");
        ;
        $manager->persist($press1);

        $press2 = new Medias();
        $press2->setName("nosepress2.gif")
            ->setTrick($this->getReference(TricksFixtures::NOSEPRESS_TRICK))
            ->setFeatured(false)
            ->setExtension("gif");
        ;
        $manager->persist($press2);

        $press3 = new Medias();
        $press3->setName('<iframe height="250" src="https://www.youtube.com/embed/RGzktM_J6WQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
            ->setTrick($this->getReference(TricksFixtures::NOSEPRESS_TRICK))
            ->setFeatured(false)
            ->setExtension("link");
        ;
        $manager->persist($press3);

        //BOARDSLIDE
        $boardslide1 = new Medias();
        $boardslide1->setName("boardslide1.jpeg")
            ->setTrick($this->getReference(TricksFixtures::BOARDSLIDE_TRICK))
            ->setFeatured(true)
            ->setExtension("jpeg");
        ;
        $manager->persist($boardslide1);

        $boardslide2 = new Medias();
        $boardslide2->setName("Boardslide2.jpeg")
            ->setTrick($this->getReference(TricksFixtures::BOARDSLIDE_TRICK))
            ->setFeatured(false)
            ->setExtension("jpeg");
        ;
        $manager->persist($boardslide2);

        $boardslide3 = new Medias();
        $boardslide3->setName('<iframe height="250" src="https://www.youtube.com/embed/NWkXQy91jbw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
            ->setTrick($this->getReference(TricksFixtures::BOARDSLIDE_TRICK))
            ->setFeatured(false)
            ->setExtension("link");
        ;
        $manager->persist($boardslide3);

        //ALLEY OOP
        $alley1 = new Medias();
        $alley1->setName("alley1.jpg")
            ->setTrick($this->getReference(TricksFixtures::ALLEY_TRICK))
            ->setFeatured(true)
            ->setExtension("jpg");
        ;
        $manager->persist($alley1);

        $alley2 = new Medias();
        $alley2->setName("alley2.jpg")
            ->setTrick($this->getReference(TricksFixtures::ALLEY_TRICK))
            ->setFeatured(false)
            ->setExtension("jpg");
        ;
        $manager->persist($alley2);

        $alley3 = new Medias();
        $alley3->setName('<iframe height="250" src="https://www.youtube.com/embed/aeQtJqRuvi8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>')
            ->setTrick($this->getReference(TricksFixtures::ALLEY_TRICK))
            ->setFeatured(false)
            ->setExtension("link");
        ;
        $manager->persist($alley3);

        //BACKSIDE 720
        $bs720_1 = new Medias();
        $bs720_1->setName("bs720_1.png")
            ->setTrick($this->getReference(TricksFixtures::BACKSIDE_TRICK))
            ->setFeatured(true)
            ->setExtension("png");
        ;
        $manager->persist($bs720_1);

        $bs720_2 = new Medias();
        $bs720_2->setName("bs720_2.png")
            ->setTrick($this->getReference(TricksFixtures::BACKSIDE_TRICK))
            ->setFeatured(false)
            ->setExtension("png");
        ;
        $manager->persist($bs720_2);

        $bs720_3 = new Medias();
        $bs720_3->setName('<iframe height="250" src="https://www.youtube.com/embed/dicFS7ofFvc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
')
            ->setTrick($this->getReference(TricksFixtures::BACKSIDE_TRICK))
            ->setFeatured(false)
            ->setExtension("link");
        ;
        $manager->persist($bs720_3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TricksFixtures::class
        ];
    }
}
