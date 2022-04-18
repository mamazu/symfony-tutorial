<?php

namespace App\Entity;

use App\Repository\WoofRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Woof
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    public $message;

    #[ORM\Column(type: 'string', length: 255)]
    public $username;

    #[ORM\Column(type: 'boolean')]
    public $contains_dogs;

    public function getId(): ?int
    {
        return $this->id;
    }

}
