<?php

namespace App\Entity;

use App\Repository\ApplicationPositionsRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\GooglePlaySingleApp;

/**
 * @ORM\Entity(repositoryClass=ApplicationPositionsRepository::class)
 */
class ApplicationPositions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * Many positions has One Applications.
     * @ORM\ManyToOne(targetEntity="GooglePlaySingleApp")
     */
    private GooglePlaySingleApp $application;

    /**
     * @ORM\Column(type="string", length=127)
     */
    private $categoryId;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=63)
     */
    private $location;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryId(): ?string
    {
        return $this->categoryId;
    }

    public function setCategoryId(string $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }
}
