<?php

namespace App\Entity;

use App\Repository\PaniersArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaniersArticlesRepository::class)]
class PaniersArticles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Paniers $id_paniers = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Articles $id_articles = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?bool $deja_payer = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdArticles(): ?Articles
    {
        return $this->id_articles;
    }

    public function setIdArticles(?Articles $id_articles): static
    {
        $this->id_articles = $id_articles;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function isDejaPayer(): ?bool
    {
        return $this->deja_payer;
    }

    public function setDejaPayer(bool $deja_payer): static
    {
        $this->deja_payer = $deja_payer;

        return $this;
    }
}
