<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class ReservationService
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Reservation::class)]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    public Reservation $reservation;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: ServiceSupplementaire::class)]
    public ServiceSupplementaire $service;

    #[ORM\Column]
    public int $quantite = 1;

    #[ORM\Column(type: 'datetime')]
    public \DateTimeInterface $dateAjout;

    public function __construct()
    {
        $this->dateAjout = new \DateTime();
    }
}