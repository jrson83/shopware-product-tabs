<?php

declare(strict_types=1);

namespace ProductTab\Core\Content\Tab;

use ProductTab\Core\Content\Tab\Aggregate\TabTranslation\TabTranslationCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;

class TabEntity extends Entity
{
    use EntityIdTrait;

    protected ?string $parentId;

    protected int $position;

    protected ?string $name;

    protected ?string $content;

    protected $translations;

    public function getParentId(): ?string
    {
        return $this->parentId;
    }

    public function setParentId(?string $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function getTranslations(): ?TabTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(TabTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }
}
