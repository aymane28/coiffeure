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
     * @ORM\OneToMany(targetEntity=ServiceType::class, mappedBy="service")
     */
    private $serviceType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Establishment::class, mappedBy="service")
     */
    private $establishment;

    public function __construct()
    {
        $this->establishment = new ArrayCollection();
        $this->serviceType = new ArrayCollection();
        $this->establishment = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, ServiceType>
     */
    public function getServiceType(): Collection
    {
        return $this->serviceType;
    }

    public function addServiceType(ServiceType $serviceType): self
    {
        if (!$this->serviceType->contains($serviceType)) {
            $this->serviceType[] = $serviceType;
            $serviceType->setService($this);
        }

        return $this;
    }

    public function removeServiceType(ServiceType $serviceType): self
    {
        if ($this->serviceType->removeElement($serviceType)) {
            // set the owning side to null (unless already changed)
            if ($serviceType->getService() === $this) {
                $serviceType->setService(null);
            }
        }

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setEstablishment(?Establishment $establishment): self
    {
        $this->establishment = $establishment;
        return $this;
    }

    /**
     * @return Collection<int, Establishment>
     */
    public function getEstablishment(): Collection
    {
        return $this->establishment;
    }

    public function addEstablishment(Establishment $establishment): self
    {
        if (!$this->establishment->contains($establishment)) {
            $this->establishment[] = $establishment;
            $establishment->setService($this);
        }

        return $this;
    }

    public function removeEstablishment(Establishment $establishment): self
    {
        if ($this->establishment->removeElement($establishment)) {
            // set the owning side to null (unless already changed)
            if ($establishment->getService() === $this) {
                $establishment->setService(null);
            }
        }

        return $this;
    }
}
