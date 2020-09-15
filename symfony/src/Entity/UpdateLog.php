<?php

namespace App\Entity;

use App\Repository\UpdateLogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UpdateLogRepository::class)
 */
class UpdateLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $updated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fileDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUpdated(): ?bool
    {
        return $this->updated;
    }

    public function setUpdated(bool $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    public function getFileDate(): ?\DateTimeInterface
    {
        return $this->fileDate;
    }

    public function setFileDate(\DateTimeInterface $fileDate): self
    {
        $this->fileDate = $fileDate;

        return $this;
    }
}
