<?php

namespace App\Entity;

use App\Repository\PaniersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaniersRepository::class)]
class Paniers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Visiteurs $id_visiteurs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdVisiteurs(): ?Visiteurs
    {
        return $this->id_visiteurs;
    }

    public function setIdVisiteurs(Visiteurs $id_visiteurs): static
    {
        $this->id_visiteurs = $id_visiteurs;

        return $this;
    }
}
