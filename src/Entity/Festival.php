<?php

namespace App\Entity;

use App\Repository\FestivalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FestivalRepository::class)
 */
class Festival
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
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coordinates;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $postCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $globalInformations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $praticalInformations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contactMail;

    /**
     * @ORM\ManyToMany(targetEntity=Artist::class, mappedBy="festival")
     */
    private $artists;

    /**
     * @ORM\OneToMany(targetEntity=Stage::class, mappedBy="festival")
     */
    private $stages;

    /**
     * @ORM\ManyToMany(targetEntity=Faq::class, mappedBy="festival")
     */
    private $faqs;

    /**
     * @ORM\ManyToMany(targetEntity=Contact::class, mappedBy="festival")
     */
    private $contacts;

    /**
     * @ORM\ManyToMany(targetEntity=Partners::class, mappedBy="festival")
     */
    private $partners;

    /**
     * @ORM\OneToMany(targetEntity=Restauration::class, mappedBy="festival")
     */
    private $restaurations;

    /**
     * @ORM\OneToMany(targetEntity=Bar::class, mappedBy="festival")
     */
    private $bars;

    /**
     * @ORM\OneToMany(targetEntity=Wc::class, mappedBy="festival")
     */
    private $wcs;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->stages = new ArrayCollection();
        $this->faqs = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->partners = new ArrayCollection();
        $this->restaurations = new ArrayCollection();
        $this->bars = new ArrayCollection();
        $this->wcs = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostCode(): ?int
    {
        return $this->postCode;
    }

    public function setPostCode(int $postCode): self
    {
        $this->postCode = $postCode;

        return $this;
    }

    public function getGlobalInformations(): ?string
    {
        return $this->globalInformations;
    }

    public function setGlobalInformations(string $globalInformations): self
    {
        $this->globalInformations = $globalInformations;

        return $this;
    }

    public function getPraticalInformations(): ?string
    {
        return $this->praticalInformations;
    }

    public function setPraticalInformations(string $praticalInformations): self
    {
        $this->praticalInformations = $praticalInformations;

        return $this;
    }

    public function getContactMail(): ?string
    {
        return $this->contactMail;
    }

    public function setContactMail(string $contactMail): self
    {
        $this->contactMail = $contactMail;

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
            $artist->addFestival($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->removeElement($artist)) {
            $artist->removeFestival($this);
        }

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setFestival($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->removeElement($stage)) {
            // set the owning side to null (unless already changed)
            if ($stage->getFestival() === $this) {
                $stage->setFestival(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Faq[]
     */
    public function getFaqs(): Collection
    {
        return $this->faqs;
    }

    public function addFaq(Faq $faq): self
    {
        if (!$this->faqs->contains($faq)) {
            $this->faqs[] = $faq;
            $faq->addFestival($this);
        }

        return $this;
    }

    public function removeFaq(Faq $faq): self
    {
        if ($this->faqs->removeElement($faq)) {
            $faq->removeFestival($this);
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->addFestival($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            $contact->removeFestival($this);
        }

        return $this;
    }

    /**
     * @return Collection|Partners[]
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partners $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners[] = $partner;
            $partner->addFestival($this);
        }

        return $this;
    }

    public function removePartner(Partners $partner): self
    {
        if ($this->partners->removeElement($partner)) {
            $partner->removeFestival($this);
        }

        return $this;
    }

    /**
     * @return Collection|Restauration[]
     */
    public function getRestaurations(): Collection
    {
        return $this->restaurations;
    }

    public function addRestauration(Restauration $restauration): self
    {
        if (!$this->restaurations->contains($restauration)) {
            $this->restaurations[] = $restauration;
            $restauration->setFestival($this);
        }

        return $this;
    }

    public function removeRestauration(Restauration $restauration): self
    {
        if ($this->restaurations->removeElement($restauration)) {
            // set the owning side to null (unless already changed)
            if ($restauration->getFestival() === $this) {
                $restauration->setFestival(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bar[]
     */
    public function getBars(): Collection
    {
        return $this->bars;
    }

    public function addBar(Bar $bar): self
    {
        if (!$this->bars->contains($bar)) {
            $this->bars[] = $bar;
            $bar->setFestival($this);
        }

        return $this;
    }

    public function removeBar(Bar $bar): self
    {
        if ($this->bars->removeElement($bar)) {
            // set the owning side to null (unless already changed)
            if ($bar->getFestival() === $this) {
                $bar->setFestival(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Wc[]
     */
    public function getWcs(): Collection
    {
        return $this->wcs;
    }

    public function addWc(Wc $wc): self
    {
        if (!$this->wcs->contains($wc)) {
            $this->wcs[] = $wc;
            $wc->setFestival($this);
        }

        return $this;
    }

    public function removeWc(Wc $wc): self
    {
        if ($this->wcs->removeElement($wc)) {
            // set the owning side to null (unless already changed)
            if ($wc->getFestival() === $this) {
                $wc->setFestival(null);
            }
        }

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }
}
