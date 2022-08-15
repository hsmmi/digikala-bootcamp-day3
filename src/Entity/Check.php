<?php

namespace App\Entity;

use App\Repository\CheckRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CheckRepository::class)]
#[ORM\Table(name: '`check`')]
class Check
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
