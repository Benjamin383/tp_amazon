<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandesRepository::class)]
class Commandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $payer = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Paniers $id_paniers = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commercants $id_commercants = null;

    #[ORM\OneToOne(mappedBy: 'id_commandes', cascade: ['persist', 'remove'])]
    private ?Factures $facture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPayer(): ?bool
    {
        return $this->payer;
    }

    public function setPayer(bool $payer): static
    {
        $this->payer = $payer;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getIdPaniers(): ?Paniers
    {
        return $this->id_paniers;
    }

    public function setIdPaniers(?Paniers $id_paniers): static
    {
        $this->id_paniers = $id_paniers;

        return $this;
    }

    public function getIdCommercants(): ?Commercants
    {
        return $this->id_commercants;
    }

    public function setIdCommercants(?Commercants $id_commercants): static
    {
        $this->id_commercants = $id_commercants;

        return $this;
    }

    public function getFacture(): ?Factures
    {
        return $this->facture;
    }

    public function setFacture(Factures $facture): static
    {
        // set the owning side of the relation if necessary
        if ($facture->getIdCommandes() !== $this) {
            $facture->setIdCommandes($this);
        }

        $this->facture = $facture;

        return $this;
    }
}
