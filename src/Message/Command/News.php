<?php

declare(strict_types=1);

namespace App\Message\Command;

class News
{

    public function __construct(string $title, string $shortDescription, string $picture, string $dateAdded)
    {
        $this->title = $title;
        $this->shortDescription = $shortDescription;
        $this->picture = $picture;
        $this->dateAdded = $dateAdded;
    }

    private $title;

    private $shortDescription;

    private $picture;

    private $dateAdded;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function getDateAdded(): ?string
    {
        return $this->dateAdded;
    }
}