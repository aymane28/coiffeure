<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Etablissement::class, mappedBy="service")
     */
    private $etablissement;

    /**
     * @ORM\OneToMany(targetEntity=Servicetype::class, mappedBy="service")
     */
    private $servicetype;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->etablissement = new ArrayCollection();
        $this->servicetype = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissement(): Collection
    {
        return $this->etablissement;
    }

    public function addEtablissement(Etablissement $etablissement): self
    {
        if (!$this->etablissement->contains($etablissement)) {
            $this->etablissement[] = $etablissement;
            $etablissement->addService($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): self
    {
        if ($this->etablissement->removeElement($etablissement)) {
            $etablissement->removeService($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, servicetype>
     */
    public function getServicetype(): Collection
    {
        return $this->servicetype;
    }

    public function addServicetype(Servicetype $servicetype): self
    {
        if (!$this->servicetype->contains($servicetype)) {
            $this->servicetype[] = $servicetype;
            $servicetype->setService($this);
        }

        return $this;
    }

    public function removeServicetype(servicetype $servicetype): self
    {
        if ($this->servicetype->removeElement($servicetype)) {
            // set the owning side to null (unless already changed)
            if ($servicetype->getService() === $this) {
                $servicetype->setService(null);
            }
        }

        return $this;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
