<?php

namespace App\Entity;

use App\Repository\SourceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SourceRepository::class)
 */
class Source
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sourceTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sourceShortDescription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sourcePicture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sourceAddDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $wrapperSelector;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $scraperClass;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSourceAddDate(): ?string
    {
        return $this->sourceAddDate;
    }

    public function setSourceAddDate(string $sourceAddDate): self
    {
        $this->sourceAddDate = $sourceAddDate;

        return $this;
    }

    public function getSourceTitle(): ?string
    {
        return $this->sourceTitle;
    }

    public function setSourceTitle(string $sourceTitle): self
    {
        $this->sourceTitle = $sourceTitle;

        return $this;
    }

    public function getSourceShortDescription(): ?string
    {
        return $this->sourceShortDescription;
    }

    public function setSourceShortDescription(string $sourceShortDescription): self
    {
        $this->sourceShortDescription = $sourceShortDescription;

        return $this;
    }

    public function getSourcePicture(): ?string
    {
        return $this->sourcePicture;
    }

    public function setSourcePicture(string $sourcePicture): self
    {
        $this->sourcePicture = $sourcePicture;

        return $this;
    }

    public function getWrapperSelector(): ?string
    {
        return $this->wrapperSelector;
    }

    public function setWrapperSelector(string $wrapperSelector): self
    {
        $this->wrapperSelector = $wrapperSelector;

        return $this;
    }

    public function getScraperClass(): ?string
    {
        return $this->scraperClass;
    }

    public function setScraperClass(string $scraperClass): self
    {
        $this->scraperClass = $scraperClass;

        return $this;
    }
}
