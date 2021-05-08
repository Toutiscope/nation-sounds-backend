<?php

namespace App\Entity;

use App\Repository\BarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BarRepository::class)
 */
class Bar
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coordinates;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=Festival::class, inversedBy="bars")
     */
    private $festival;

    /**
     * @ORM\ManyToOne(targetEntity=PoiCategory::class, inversedBy="idBar")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getcompany(): ?string
    {
        return $this->company;
    }

    public function setcompany(string $company): self
    {
        $this->company = $company;

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
}
