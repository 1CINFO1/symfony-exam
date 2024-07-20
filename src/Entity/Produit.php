<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $nbProduit = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?int $nbLikes = 0;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $dateFa = null;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getNbProduit(): ?int
    {
        return $this->nbProduit;
    }

    public function setNbProduit(int $nbProduit): self
    {
        $this->nbProduit = $nbProduit;
        return $this;
    }

    public function getnbLikes(): ?int
    {
        return $this->nbLikes;
    }

    public function setnbLikes(int $nbLikes): self
    {
        $this->nbLikes = $nbLikes;
        return $this;
    }

    public function getDateFa(): ?\DateTimeInterface
    {
        return $this->dateFa;
    }

    public function setDateFa(\DateTimeInterface $dateFa): self
    {
        $this->dateFa = $dateFa;
        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;
        return $this;
    }
}
