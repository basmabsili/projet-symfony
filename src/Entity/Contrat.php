<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_depart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_retour;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $km_depart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $km_retour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(?\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->date_retour;
    }

    public function setDateRetour(?\DateTimeInterface $date_retour): self
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    public function getKmDepart(): ?int
    {
        return $this->km_depart;
    }

    public function setKmDepart(?int $km_depart): self
    {
        $this->km_depart = $km_depart;

        return $this;
    }

    public function getKmRetour(): ?int
    {
        return $this->km_retour;
    }

    public function setKmRetour(?int $km_retour): self
    {
        $this->km_retour = $km_retour;

        return $this;
    }
}
