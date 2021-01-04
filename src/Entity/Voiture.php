<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $carburant;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponibilite;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrplace;

    /**
     * @ORM\OneToOne(targetEntity=Emplacement::class, mappedBy="idvoiture", cascade={"persist", "remove"})
     */
    private $emplacement;

    

    /**
     * @ORM\OneToMany(targetEntity=Voiture::class, mappedBy="contrat")
     */
    private $voitures;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getmatricule(): ?string
    {
        return $this->matricule;
    }

    public function setmatricule(string $matricule): self
    {
        $this->matricule = $matricule;

       return $this;
    }

    public function getmarque(): ?string
    {
        return $this->marque;
    }

    public function setmarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getcouleur(): ?string
    {
        return $this->couleur;
    }

    public function setcouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getcarburant(): ?string
    {
        return $this->carburant;
    }

    public function setcarburant(?string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getdescription(): ?string
    {
        return $this->description;
    }

    public function setdescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getdate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setdate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getdisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setdisponibilite(bool $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getnbrplace(): ?int
    {
        return $this->nbrplace;
    }

    public function setnbrplace(int $nbrplace): self
    {
        $this->nbrplace = $nbrplace;

        return $this;
    }

    public function getEmplacement(): ?Emplacement
    {
        return $this->emplacement;
    }

    public function setEmplacement(Emplacement $emplacement): self
    {
        $this->emplacement = $emplacement;

        // set the owning side of the relation if necessary
        if ($emplacement->getIdvoiture() !== $this) {
            $emplacement->setIdvoiture($this);
        }

        return $this;
    }

   
    /**
     * @return Collection|self[]
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(self $voiture): self
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures[] = $voiture;
            $voiture->setContrat($this);
        }

        return $this;
    }

    public function removeVoiture(self $voiture): self
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getContrat() === $this) {
                $voiture->setContrat(null);
            }
        }

        return $this;
    }
}
