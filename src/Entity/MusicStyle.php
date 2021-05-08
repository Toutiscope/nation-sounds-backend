<?php

namespace App\Entity;

use App\Repository\MusicStyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MusicStyleRepository::class)
 */
class MusicStyle
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
     * @ORM\OneToMany(targetEntity=Artist::class, mappedBy="musicStyle")
     */
    private $artist;

    public function __construct()
    {
        $this->artist = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->name;
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
     * @return Collection|artist[]
     */
    public function getArtist(): Collection
    {
        return $this->artist;
    }

    public function addArtist(artist $artist): self
    {
        if (!$this->artist->contains($artist)) {
            $this->artist[] = $artist;
            $artist->setMusicStyle($this);
        }

        return $this;
    }


    public function removeArtist(artist $artist): self
    {
        if ($this->artist->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getMusicStyle() === $this) {
                $artist->setMusicStyle(null);
            }
        }

        return $this;
    }
}
