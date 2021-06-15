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
     * @ORM\ManyToOne(targetEntity=Application::class)
     */
    private $application;

    /**
     * @ORM\Column(type="string", length=127)
     */
    private $categoryId;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": 0})
     */
    private int $position;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default": 0})
     */
    private int $index;

    /**
     * @ORM\Column(type="string", length=15, nullable=false)
     */
    private string $language;

    /**
     * @ORM\Column(type="string", length=15, nullable=false)
     */
    private string $location;

    /**
     * @ORM\Column(type="string", length=15, nullable=false)
     */
    private string $country;

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

    public function getApplication()
    {
        return $this->application;
    }

    public function setApplication($application): self
    {
        $this->application = $application;

        return $this;
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function setIndex(int $index): self
    {
        $this->index = $index;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
