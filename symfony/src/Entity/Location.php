<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="location", indexes={@ORM\Index(name="type_idx", columns={"type"}),
 *      @ORM\Index(name="code_idx", columns={"code"})})
 * @ORM\DiscriminatorColumn(name="type", type="string", length=3)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({
 *     "old" = "LocationProd",
 *     "new" = "LocationImport",
 * })
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
abstract class Location
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

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $port;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $rail;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $road;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $airport;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $postoffice;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $reserved1;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $reserved2;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $border;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $notknown;
    
    public function __construct()
    {
        $this->setPort(0);
        $this->setRail(0);
        $this->setRoad(0);
        $this->setAirport(0);
        $this->setPostoffice(0);
        $this->setReserved1(0);
        $this->setReserved2(0);
        $this->setBorder(0);
        $this->setNotknown(0);
    }

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

    public function getPort(): ?bool
    {
        return $this->port;
    }

    public function setPort(bool $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function getRail(): ?bool
    {
        return $this->rail;
    }

    public function setRail(bool $rail): self
    {
        $this->rail = $rail;

        return $this;
    }

    public function getRoad(): ?bool
    {
        return $this->road;
    }

    public function setRoad(bool $road): self
    {
        $this->road = $road;

        return $this;
    }

    public function getAirport(): ?bool
    {
        return $this->airport;
    }

    public function setAirport(bool $airport): self
    {
        $this->airport = $airport;

        return $this;
    }

    public function getPostoffice(): ?bool
    {
        return $this->postoffice;
    }

    public function setPostoffice(bool $postoffice): self
    {
        $this->postoffice = $postoffice;

        return $this;
    }

    public function getReserved1(): ?bool
    {
        return $this->reserved1;
    }

    public function setReserved1(bool $reserved1): self
    {
        $this->reserved1 = $reserved1;

        return $this;
    }

    public function getReserved2(): ?bool
    {
        return $this->reserved2;
    }

    public function setReserved2(bool $reserved2): self
    {
        $this->reserved2 = $reserved2;

        return $this;
    }

    public function getBorder(): ?bool
    {
        return $this->border;
    }

    public function setBorder(bool $border): self
    {
        $this->border = $border;

        return $this;
    }

    public function getNotknown(): ?bool
    {
        return $this->notknown;
    }

    public function setNotknown(bool $notknown): self
    {
        $this->notknown = $notknown;

        return $this;
    }
}
