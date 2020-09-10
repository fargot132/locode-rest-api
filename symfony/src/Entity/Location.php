<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
        
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;
    
    /**
     * @ORM\Column(type="string", length=3)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameWoDiacritics;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $subdivision;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $functionCode;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $iata;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $coordinates;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getCountry()
    {
        return $this->country;
    }
    
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getNameWoDiacritics(): ?string
    {
        return $this->nameWoDiacritics;
    }

    public function setNameWoDiacritics(string $nameWoDiacritics): self
    {
        $this->nameWoDiacritics = $nameWoDiacritics;

        return $this;
    }

    public function getSubdivision(): ?string
    {
        return $this->subdivision;
    }

    public function setSubdivision(?string $subdivision): self
    {
        $this->subdivision = $subdivision;

        return $this;
    }

    public function getFunctionCode(): ?string
    {
        return $this->functionCode;
    }

    public function setFunctionCode(string $functionCode): self
    {
        $this->functionCode = $functionCode;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIata(): ?string
    {
        return $this->iata;
    }

    public function setIata(?string $iata): self
    {
        $this->iata = $iata;

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
}
