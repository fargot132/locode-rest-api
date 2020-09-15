<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="country", indexes={@ORM\Index(name="type_idx", columns={"type"}),
 *      @ORM\Index(name="code_idx", columns={"code"})})
 * @ORM\DiscriminatorColumn(name="type", type="string", length=3)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorMap({
 *     "old" = "CountryProd",
 *     "new" = "CountryImport",
 * })
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
abstract class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
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
}
