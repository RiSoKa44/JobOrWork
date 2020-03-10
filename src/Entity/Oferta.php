<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfertaRepository")
 */
class Oferta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcio;

    /**
     * @ORM\Column(type="date")
     */
    private $dataPub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titol;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\empresa", inversedBy="ofertas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $empresa;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\candidat", mappedBy="oferta")
     */
    private $candidats;

    public function __construct()
    {
        $this->oferta = new ArrayCollection();
        $this->candidats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcio(): ?string
    {
        return $this->descripcio;
    }

    public function setDescripcio(string $descripcio): self
    {
        $this->descripcio = $descripcio;

        return $this;
    }

    public function getDataPub(): ?\DateTimeInterface
    {
        return $this->dataPub;
    }

    public function setDataPub(\DateTimeInterface $dataPub): self
    {
        $this->dataPub = $dataPub;

        return $this;
    }

    public function getTitol(): ?string
    {
        return $this->titol;
    }

    public function setTitol(string $titol): self
    {
        $this->titol = $titol;

        return $this;
    }

    public function getEmpresa(): ?empresa
    {
        return $this->empresa;
    }

    public function setEmpresa(?empresa $empresa): self
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * @return Collection|candidat[]
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(candidat $candidat): self
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats[] = $candidat;
            $candidat->setOferta($this);
        }

        return $this;
    }

    public function removeCandidat(candidat $candidat): self
    {
        if ($this->candidats->contains($candidat)) {
            $this->candidats->removeElement($candidat);
            // set the owning side to null (unless already changed)
            if ($candidat->getOferta() === $this) {
                $candidat->setOferta(null);
            }
        }

        return $this;
    }
}
