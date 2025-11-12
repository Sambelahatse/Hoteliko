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
    private Reservation $reservation;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: ServiceSupplementaire::class)]
    private ServiceSupplementaire $service;

    #[ORM\Column]
    private int $quantite = 1;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dateAjout;

    public function __construct()
    {
        $this->dateAjout = new \DateTime();
    }

    public function getReservation(): Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        $this->reservation = $reservation;
        return $this;
    }

    public function getService(): ServiceSupplementaire
    {
        return $this->service;
    }

    public function setService(ServiceSupplementaire $service): self
    {
        $this->service = $service;
        return $this;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;
        return $this;
    }

    public function getDateAjout(): \DateTimeInterface
    {
        return $this->dateAjout;
    }

    public function setDateAjout(\DateTimeInterface $dateAjout): self
    {
        $this->dateAjout = $dateAjout;
        return $this;
    }

}