<?php

namespace App\Entity;

use App\Repository\GooglePlaySingleAppRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=GooglePlaySingleAppRepository::class)
 */
class GooglePlaySingleApp
{
    use SoftDeleteableEntity, Timestampable;

    public const DEFAULT_LANGUAGE = 'en-US';
    public const DEFAULT_COUNTRY = 'us';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private string $storeId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * One Application has many ApplicationPosition s.
     * @ORM\OneToMany(targetEntity="ApplicationPositions", mappedBy="application")
     */
    private $applicationPositions;

    /**
     * @ORM\Column(type="string", length=2047)
     */
    private string $url;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private string $language = self::DEFAULT_LANGUAGE;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private string $location = self::DEFAULT_COUNTRY;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private bool $isFree;

    /**
     * @ORM\Column(type="string", length=2047, nullable=true)
     */
    private string $iconUrl;

    /**
     * @ORM\Column(type="blob", nullable=true, options={"default": 0})
     */
    private ?string $iconBinary;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $categoryId;

    /**
     * @ORM\Column(type="string", length=31, nullable=true, options={"default": "GOOGLE_PLAY"})
     */
    private ?string $marketType;

    /**
     * @ORM\Column(type="integer")
     */
    private int $developerId;

    public function __construct()
    {
        $this->applicationPositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getIsFree(): ?bool
    {
        return $this->isFree;
    }

    public function setIsFree(bool $isFree): self
    {
        $this->isFree = $isFree;

        return $this;
    }

    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    public function setIconUrl(string $iconUrl): self
    {
        $this->iconUrl = $iconUrl;

        return $this;
    }

    public function getIconBinary(): ?string
    {
        return $this->iconBinary;
    }

    public function setIconBinary(?string $iconBinary): self
    {
        $this->iconBinary = $iconBinary;

        return $this;
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

    public function getMarketType(): ?string
    {
        return $this->marketType;
    }

    public function setMarketType(string $marketType): self
    {
        $this->marketType = $marketType;

        return $this;
    }

    public function getDeveloperId(): ?int
    {
        return $this->developerId;
    }

    public function setDeveloperId(int $developerId): self
    {
        $this->developerId = $developerId;

        return $this;
    }

    public function getStoreId(): string
    {
        return $this->storeId;
    }

    public function setStoreId(string $storeId): self
    {
        $this->storeId = $storeId;

        return $this;
    }

//    public function getPosition(): ?int
//    {
//        return $this->position;
//    }
//
//    public function setPosition(?int $position): self
//    {
//        $this->position = $position;
//
//        return $this;
//    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTime $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


}
