<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put(security: "is_granted('ROLE_ADMIN') or object.client == user")
    ]
)]
class Reservation
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Client::class)]
    #[ORM\JoinColumn(nullable: false)]
    public Client $client;

    #[ORM\ManyToOne(targetEntity: Chambre::class)]
    #[ORM\JoinColumn(nullable: false)]
    public Chambre $chambre;

    #[ORM\Column(type: 'date')]
    public \DateTimeInterface $dateDebut;

    #[ORM\Column(type: 'date')]
    public \DateTimeInterface $dateFin;

    #[ORM\Column]
    public string $statut = 'En attente';

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public string $prixTotal = '0.00';

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