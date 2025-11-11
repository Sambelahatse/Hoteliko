<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class Paiement
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Reservation::class)]
    #[ORM\JoinColumn(nullable: false)]
    public Reservation $reservation;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public string $montant;

    #[ORM\Column]
    public string $methode;

    #[ORM\Column(type: 'datetime')]
    public \DateTimeInterface $datePaiement;

    #[ORM\Column]
    public string $statut = 'En attente';

    public function __construct()
    {
        $this->datePaiement = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}