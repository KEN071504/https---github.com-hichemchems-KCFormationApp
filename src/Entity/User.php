<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\HttpFoundation\File\UploadedFileInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;




#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[Vich\Uploadable]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_FORMATEUR = 'ROLE_FORMATEUR';
    const ROLE_APPRENANT = 'ROLE_APPRENANT';
    const ROLE_CLIENT = 'ROLE_CLIENT';
    const QUALITE_M = 'M.';
    const QUALITE_MME = 'Mme';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idFormation = null;

    #[ORM\Column(type: "string")]
    #[Assert\Choice(["M.", "Mme"], message: "Veuillez sélectionner une qualité valide (M. ou Mme)")]
    private ?string $qualite;


    #[Vich\UploadableField(mapping: "user_document", fileNameProperty: "documentName")]
    private ?File $document = null;

    #[Assert\File(
        maxSize: '1024k',
        mimeTypes: ['application/pdf', 'application/msword'],
        mimeTypesMessage: 'Please upload a valid PDF or Word document.',
    )]
    private ?string $documentName = null;


    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: 'array')]
    private $dossier = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        //$this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIdFormation(): ?string
    {
        return $this->idFormation;
    }

    public function setIdFormation(?string $idFormation): static
    {
        $this->idFormation = $idFormation;

        return $this;
    }

    public function setQualite(string $qualite): static
    {
        $this->qualite = $qualite;
    
        return $this;
    }
    
    public function getQualite(): ?string
    {
        return $this->qualite;
    }
    public function getDocument(): ?File
    {
        return $this->document;
    }
    
    public function setDocument(?File $document): self
{
    $this->document = $document;

    if ($document) {
        $this->documentName = $document->getFilename();
    }

    return $this;
}
    public function getDocumentName(): ?string
    {
        return $this->documentName;
    }
    
    public function setDocumentName(?string $documentName): self
    {
        $this->documentName = $documentName;
    
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function addDossier(array $dossier): void
    {
        $this->dossier[] = $dossier;
    }

    public function getdossier(): array
    {
        return $this->dossier;
    }




    public function isFormateur(): bool
    {
        return in_array(self::ROLE_FORMATEUR, $this->getRoles());
    }

    public function isClient(): bool
    {
        return in_array(self::ROLE_CLIENT, $this->getRoles());
    }

    public function isApprenant(): bool
    {
        return in_array(self::ROLE_APPRENANT, $this->getRoles());
    }

    public function isAdmin(): bool
    {
        return in_array(self::ROLE_ADMIN, $this->getRoles());
    }

    

    
}