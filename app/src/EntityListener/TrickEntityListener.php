<?php


namespace App\EntityListener;



use App\Entity\Tricks;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class TrickEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Tricks $trick, LifecycleEventArgs $event)
    {
        $trick->makeSlug($this->slugger);
    }

    public function preUpdate(Tricks $trick, LifecycleEventArgs $event)
    {
        $trick->makeSlug($this->slugger);
    }
}