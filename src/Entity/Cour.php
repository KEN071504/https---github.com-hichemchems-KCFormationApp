<?php

namespace App\Entity;

use App\Repository\CourRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use DateTimeImmutable;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CourRepository::class)]
#[Vich\Uploadable]
class Cour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'lecons', fileNameProperty: 'leconsName')]
    private ?File $leconsFile = null;

    #[ORM\Column(length: 255)]
    private ?string $leconsName = null;

    #[Vich\UploadableField(mapping: 'devoirs', fileNameProperty: 'devoirsName')]
    private ?File $devoirsFile = null;

    #[ORM\Column(length: 255)]
    private ?string $devoirsName = null;

    #[Vich\UploadableField(mapping: 'deposer', fileNameProperty: 'deposerName')]
    private ?File $deposerFile = null;

    #[ORM\Column(length: 255)]
    private ?string $deposerName = null;

    #[Vich\UploadableField(mapping: 'aide_aux_devoirs', fileNameProperty: 'aideAuxDevoirsName')]
    private ?File $aideAuxDevoirsFile = null;

    #[ORM\Column(length: 255)]
    private ?string $aideAuxDevoirsName = null;

    #[Vich\UploadableField(mapping: 'messages', fileNameProperty: 'messagesName')]
    private ?File $messagesFile = null;

    #[ORM\Column(length: 255)]
    private ?string $messagesName = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\Column(type: 'array')]
    private ?array $files = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeconsFile(): ?File
    {
        return $this->leconsFile;
    }

    public function setLeconsFile(?File $leconsFile = null): void
    {
        $this->leconsFile = $leconsFile;

        if (null !== $leconsFile) {
            // It is required that at least one field changes if you are using Doctrine,
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getLeconsName(): ?string
    {
        return $this->leconsName;
    }

    public function setLeconsName(?string $leconsName): void
    {
        $this->leconsName = $leconsName;
    }
    public function getDevoirsFile(): ?File
    {
        return $this->devoirsFile;
    }
    
    public function setDevoirsFile(?File $devoirsFile = null): void
    {
        $this->devoirsFile = $devoirsFile;
    
        if (null !== $devoirsFile) {
            // It is required that at least one field changes if you are using Doctrine,
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    
    public function getDevoirsName(): ?string
    {
        return $this->devoirsName;
    }
    
    public function setDevoirsName(?string $devoirsName): void
    {
        $this->devoirsName = $devoirsName;
    }
    
    public function getDeposerFile(): ?File
    {
        return $this->deposerFile;
    }
    
    public function setDeposerFile(?File $deposerFile = null): void
    {
        $this->deposerFile = $deposerFile;
    
        if (null !== $deposerFile) {
            // It is required that at least one field changes if you are using Doctrine,
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    
    public function getDeposerName(): ?string
    {
        return $this->deposerName;
    }
    
    public function setDeposerName(?string $deposerName): void
    {
        $this->deposerName = $deposerName;
    }
    
    public function getAideAuxDevoirsFile(): ?File
    {
        return $this->aideAuxDevoirsFile;
    }
    
    public function setAideAuxDevoirsFile(?File $aideAuxDevoirsFile = null): void
    {
        $this->aideAuxDevoirsFile = $aideAuxDevoirsFile;
    
        if (null !== $aideAuxDevoirsFile) {
            // It is required that at least one field changes if you are using Doctrine,
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    
    public function getAideAuxDevoirsName(): ?string
    {
        return $this->aideAuxDevoirsName;
    }
    
    public function setAideAuxDevoirsName(?string $aideAuxDevoirsName): void
    {
        $this->aideAuxDevoirsName = $aideAuxDevoirsName;
    }
    
    public function getMessagesFile(): ?File
    {
        return $this->messagesFile;
    }
    
    public function setMessagesFile(?File $messagesFile = null): void
    {
        $this->messagesFile = $messagesFile;
    
        if (null !== $messagesFile) {
            // It is required that at least one field changes if you are using Doctrine,
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    
    public function getMessagesName(): ?string
    {
        return $this->messagesName;
    }
    
    public function setMessagesName(?string $messagesName): void
    {
        $this->messagesName = $messagesName;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
    return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeImmutable $updatedAt): void
    {
    $this->updatedAt = $updatedAt;
    }

    public function addFile(File $file, string $name): void
    {
        $this->files[] = ['file' => $file, 'name' => $name];
    }

    public function getFiles(): ?array
    {
        return $this->files;
    }
}

