<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
#[Vich\Uploadable]
class Agent implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'avatar', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    #[ORM\Column(type: 'integer')]
    private ?int $imageSize = null;
    
    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $matricule = null;

    #[ORM\Column]
    private ?int $Num_telephone = null;

    #[ORM\OneToMany(mappedBy: 'Agent', targetEntity: Amende::class)]
    private Collection $amendes;

    #[ORM\Column]
    private ?bool $actif = null;


    public function __construct()
    {
        $this->amendes = new ArrayCollection();
        $this->actif=false;
        $this->matricule=0;
    }

    public function __toString()
    {
        return $this->getUsername();
    }
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has cadet
        if(sizeof($this->roles)==0){
            $roles[] = 'ROLE_CADET';
        }


        return array_unique($roles);
    }

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getMatricule(): ?int
    {
        return $this->matricule;
    }

    public function setMatricule(int $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNumTelephone(): ?int
    {
        return $this->Num_telephone;
    }

    public function setNumTelephone(int $Num_telephone): self
    {
        $this->Num_telephone = $Num_telephone;

        return $this;
    }

    /**
     * @return Collection<int, Amende>
     */
    public function getAmendes(): Collection
    {
        return $this->amendes;
    }

    public function addAmende(Amende $amende): self
    {
        if (!$this->amendes->contains($amende)) {
            $this->amendes->add($amende);
            $amende->setAgent($this);
        }

        return $this;
    }

    public function removeAmende(Amende $amende): self
    {
        if ($this->amendes->removeElement($amende)) {
            // set the owning side to null (unless already changed)
            if ($amende->getAgent() === $this) {
                $amende->setAgent(null);
            }
        }

        return $this;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }


}
