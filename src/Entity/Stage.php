<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StageRepository::class)
 */
class Stage
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coordinates;

    /**
     * @ORM\OneToMany(targetEntity=Concert::class, mappedBy="stage")
     */
    private $concerts;

    /**
     * @ORM\ManyToOne(targetEntity=Festival::class, inversedBy="stages")
     */
    private $festival;

    /**
     * @ORM\ManyToOne(targetEntity=PoiCategory::class, inversedBy="idStage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    public function __construct()
    {
        $this->concerts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    public function setCoordinates(string $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    /**
     * @return Collection|Concert[]
     */
    public function getConcerts(): Collection
    {
        return $this->concerts;
    }

    public function addConcert(Concert $concert): self
    {
        if (!$this->concerts->contains($concert)) {
            $this->concerts[] = $concert;
            $concert->setStage($this);
        }

        return $this;
    }

    public function removeConcert(Concert $concert): self
    {
        if ($this->concerts->removeElement($concert)) {
            // set the owning side to null (unless already changed)
            if ($concert->getStage() === $this) {
                $concert->setStage(null);
            }
        }

        return $this;
    }

    public function getFestival(): ?festival
    {
        return $this->festival;
    }

    public function setFestival(?festival $festival): self
    {
        $this->festival = $festival;

        return $this;
    }

    public function getCategory(): ?PoiCategory
    {
        return $this->category;
    }

    public function setCategory(?PoiCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
    
    public function __toString()
    {
        return $this->title;
    }
}
