<?php

declare(strict_types=1);

namespace ProductTab\Core\Content\Tab\Aggregate\TabTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\TranslationEntity;

class TabTranslationEntity extends TranslationEntity
{
    protected string $tabId;

    protected string $tabVersionId;

    protected ?string $name;

    protected ?string $content;

    public function getTabId(): string
    {
        return $this->tabId;
    }

    public function setTabId(string $tabId): void
    {
        $this->tabId = $tabId;
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

    public function getTabVersionId(): string
    {
        return $this->tabVersionId;
    }

    public function setTabVersionId(string $tabVersionId): void
    {
        $this->tabVersionId = $tabVersionId;
    }
}
