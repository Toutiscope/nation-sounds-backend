<?php

namespace App\Entity;

use App\Repository\MeetingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MeetingRepository::class)
 */
class Meeting
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coordinates;

     /**
     * @ORM\Column(type="integer", nullable=true)
     */
  
    private $hour;

   /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $day;

    /**
     *
     * @ORM\OneToMany(targetEntity=Artist::class, mappedBy="meeting")
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

    public function getHour(): ?int
    {
        return $this->hour;
    }

    public function setHour(?int $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(?string $day): self
    {
        $this->day = $day;

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
        if (!$this->$artist->contains($artist)) {
            $this->artist[] = $artist;
            $artist->setMeeting($this);
        }

        return $this;
    }

    public function removeArtist(artist $artist): self
    {
        if ($this->$artist->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getMeeting() === $this) {
                $artist->setMeeting(null);
            }
        }

        return $this;
    }
}
