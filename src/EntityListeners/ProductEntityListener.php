<?php

namespace App\EntityListeners;

use Doctrine\ORM\Event\LifecycleEventArgs;

class ProductEntityListener
{

    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function prePersist(Product $product, LifecycleEventArgs $eventArgs)
    {
        $product->setSlug($this->slugger->slugify($product->getTitle()));
    }

    public function preUpdate(Product $product, LifecycleEventArgs $eventArgs)
    {
        $product->generateSlug($this->slugger);
    }
}