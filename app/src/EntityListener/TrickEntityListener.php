<?php

namespace App\EntityListener;

use App\Entity\Tricks;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class TrickEntityListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Tricks $trick, LifecycleEventArgs $event)
    {
        $trick->makeSlug($this->slugger);
        $trick->setCreatedAt();
    }

    public function preUpdate(Tricks $trick, PreUpdateEventArgs $event)
    {
        if ($event->hasChangedField('name')) {
            // Do something when the username is changed.
            $trick->makeSlug($this->slugger);
        }

        $trick->setUpdatedAt();
    }
}
