<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource(operations: [new Get(), new GetCollection(), new Post()])]
class Chambre
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(length: 10, unique: true)]
    public string $numero;

    #[ORM\Column]
    public string $type; // Simple, Double, Suite...

    #[ORM\Column]
    public int $capacite;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    public string $prixParNuit;

    #[ORM\Column]
    public string $statut = 'Disponible';

    #[ORM\Column(type: 'text', nullable: true)]
    public ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}