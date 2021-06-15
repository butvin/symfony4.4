<?php

namespace App\Entity;

use App\Repository\ApplicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=ApplicationRepository::class)
 */
class Application
{
    use SoftDeleteableEntity, Timestampable;

    public const DEFAULT_LOCALE = 'en-US';
    public const DEFAULT_COUNTRY = 'us';
    public const TYPE_MARKET_APPLE = 'Apple Store';
    public const TYPE_MARKET_GOOGLE = 'GooglePlay Market';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private ?string $googleAppsId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
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
    private string $locale = self::DEFAULT_LOCALE;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private string $country = self::DEFAULT_COUNTRY;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private bool $isFree;

    /**
     * @ORM\Column(type="string", length=2047, nullable=true)
     */
    private string $iconUrl;

    /**
     * @ORM\Column(type="string", length=2047, nullable=true)
     */
    private string $iconPath;

    /**
     * @ORM\Column(type="blob", nullable=true, options={"default": 0})
     */
    private ?string $iconBinary;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $categoryId;

    /**
     * @ORM\Column(type="string", length=31, nullable=false)
     */
    private string $marketType = self::TYPE_MARKET_GOOGLE;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private int $developer;

    public function __construct()
    {
        $this->applicationPositions = new ArrayCollection();
    }

    public function getId(): int
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

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

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

    public function setIconBinary(string $iconBinary): self
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

    public function getMarketType(): string
    {
        return $this->marketType;
    }

    public function setMarketType(string $marketType): self
    {
        $this->marketType = $marketType;

        return $this;
    }

    public function getDeveloper(): ?string
    {
        return $this->developer;
    }

    public function setDeveloper(string $developer): self
    {
        $this->developer = $developer;

        return $this;
    }

    public function getGoogleAppsId(): string
    {
        return $this->googleAppsId;
    }

    public function setGoogleAppsId(string $googleAppsId): self
    {
        $this->googleAppsId = $googleAppsId;

        return $this;
    }

//    public function getApplicationPositions(): ArrayCollection
//    {
//        return $this->applicationPositions;
//    }
//
//    public function setApplicationPositions(ArrayCollection $applicationPositions): void
//    {
//        $this->applicationPositions = $applicationPositions;
//    }

    public function getIconPath(): string
    {
        return $this->iconPath;
    }

    public function setIconPath(string $iconPath): self
    {
        $this->iconPath = $iconPath;

        return $this;
    }

    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(\DateTime $deletedAt): self
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
