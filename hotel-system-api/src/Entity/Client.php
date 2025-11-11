<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(security: "is_granted('ROLE_ADMIN')")
    ]
)]
class Client
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    public string $nom;

    #[ORM\Column(length: 100)]
    public string $prenom;

    #[ORM\Column(length: 150, unique: true, nullable: true)]
    public ?string $email = null;

    #[ORM\Column(length: 20, nullable: true)]
    public ?string $telephone = null;

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $adresse = null;

    #[ORM\Column(type: 'datetime')]
    public \DateTimeInterface $dateCreation;

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}