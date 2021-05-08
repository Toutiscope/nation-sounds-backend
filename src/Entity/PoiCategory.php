<?php

namespace App\Entity;

use App\Repository\PoiCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PoiCategoryRepository::class)
 */
class PoiCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Stage::class, mappedBy="category", orphanRemoval=false)
     */
    private $idStage;

    /**
     * @ORM\OneToMany(targetEntity=Wc::class, mappedBy="category", orphanRemoval=false)
     */
    private $idWc;

    /**
     * @ORM\OneToMany(targetEntity=Bar::class, mappedBy="category", orphanRemoval=false)
     */
    private $idBar;

    /**
     * @ORM\OneToMany(targetEntity=Restauration::class, mappedBy="category", orphanRemoval=false)
     */
    private $idCatering;

    public function __construct()
    {
        $this->idStage = new ArrayCollection();
        $this->idWc = new ArrayCollection();
        $this->idBar = new ArrayCollection();
        $this->idCatering = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getidStage(): Collection
    {
        return $this->idStage;
    }

    public function addidStage(Stage $idStage): self
    {
        if (!$this->idStage->contains($idStage)) {
            $this->idStage[] = $idStage;
            $idStage->setCategory($this);
        }

        return $this;
    }

    public function removeidStage(Stage $idStage): self
    {
        if ($this->idStage->removeElement($idStage)) {
            // set the owning side to null (unless already changed)
            if ($idStage->getCategory() === $this) {
                $idStage->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|Wc[]
     */
    public function getIdWc(): Collection
    {
        return $this->idWc;
    }

    public function addIdWc(Wc $idWc): self
    {
        if (!$this->idWc->contains($idWc)) {
            $this->idWc[] = $idWc;
            $idWc->setCategory($this);
        }

        return $this;
    }

    public function removeIdWc(Wc $idWc): self
    {
        if ($this->idWc->removeElement($idWc)) {
            // set the owning side to null (unless already changed)
            if ($idWc->getCategory() === $this) {
                $idWc->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bar[]
     */
    public function getIdBar(): Collection
    {
        return $this->idBar;
    }

    public function addIdBar(Bar $idBar): self
    {
        if (!$this->idBar->contains($idBar)) {
            $this->idBar[] = $idBar;
            $idBar->setCategory($this);
        }

        return $this;
    }

    public function removeIdBar(Bar $idBar): self
    {
        if ($this->idBar->removeElement($idBar)) {
            // set the owning side to null (unless already changed)
            if ($idBar->getCategory() === $this) {
                $idBar->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Restauration[]
     */
    public function getIdCatering(): Collection
    {
        return $this->idCatering;
    }

    public function addIdCatering(Restauration $idCatering): self
    {
        if (!$this->idCatering->contains($idCatering)) {
            $this->idCatering[] = $idCatering;
            $idCatering->setCategory($this);
        }

        return $this;
    }

    public function removeIdCatering(Restauration $idCatering): self
    {
        if ($this->idCatering->removeElement($idCatering)) {
            // set the owning side to null (unless already changed)
            if ($idCatering->getCategory() === $this) {
                $idCatering->setCategory(null);
            }
        }

        return $this;
    }
}
