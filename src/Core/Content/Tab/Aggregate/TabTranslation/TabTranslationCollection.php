<?php

declare(strict_types=1);

namespace ProductTab\Core\Content\Tab\Aggregate\TabTranslation;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @extends EntityCollection<TabTranslationEntity>
 */
class TabTranslationCollection extends EntityCollection
{
    /**
     * @return array<string>
     */
    public function getCategoryIds(): array
    {
        return $this->fmap(fn (TabTranslationEntity $tabTranslation) => $tabTranslation->getTabId());
    }

    public function filterByCategoryId(string $id): self
    {
        return $this->filter(fn (TabTranslationEntity $tabTranslation) => $tabTranslation->getTabId() === $id);
    }

    /**
     * @return array<string>
     */
    public function getLanguageIds(): array
    {
        return $this->fmap(fn (TabTranslationEntity $tabTranslation) => $tabTranslation->getLanguageId());
    }

    public function filterByLanguageId(string $id): self
    {
        return $this->filter(fn (TabTranslationEntity $tabTranslation) => $tabTranslation->getLanguageId() === $id);
    }

    public function getApiAlias(): string
    {
        return 'tab_translation_collection';
    }

    protected function getExpectedClass(): string
    {
        return TabTranslationEntity::class;
    }
}
