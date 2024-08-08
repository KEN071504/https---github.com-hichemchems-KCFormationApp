<?php

namespace App\Entity;

use App\Repository\FormationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationsRepository::class)]
class Formations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Intitule = null;

    #[ORM\Column(type: 'string')]
    private $Diplome;

    #[ORM\Column(length: 255)]
    private ?string $Descriptif = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateSession = null;

    #[ORM\Column(length: 255)]
    private ?string $Financement = null;

    #[ORM\Column(length: 255)]
    private ?string $Type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->Intitule;
    }

    public function setIntitule(string $Intitule): static
    {
        $this->Intitule = $Intitule;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this-> Diplome;
    }

    public function setDiplome(string $Diplome): self
    {
        $this->Diplome = $Diplome;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->Descriptif;
    }

    public function setDescriptif(string $Descriptif): static
    {
        $this->Descriptif = $Descriptif;

        return $this;
    }

    public function getDateSession(): ?\DateTimeInterface
    {
        return $this->DateSession;
    }

    public function setDateSession(\DateTimeInterface $DateSession): static
    {
        $this->DateSession = $DateSession;

        return $this;
    }

    public function getFinancement(): ?string
    {
        return $this->Financement;
    }

    public function setFinancement(string $Financement): static
    {
        $this->Financement = $Financement;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): static
    {
        $this->Type = $Type;

        return $this;
    }
}
