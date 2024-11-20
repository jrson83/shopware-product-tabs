<?php

declare(strict_types=1);

namespace ProductTab\Core\Content\Tab;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @method void           add(TabEntity $entity)
 * @method void           set(string $key, TabEntity $entity)
 * @method TabEntity[]    getIterator()
 * @method TabEntity[]    getElements()
 * @method TabEntity|null get(string $key)
 * @method TabEntity|null first()
 * @method TabEntity|null last()
 */
class TabCollection extends EntityCollection
{
    public function getApiAlias(): string
    {
        return 'tab_collection';
    }

    protected function getExpectedClass(): string
    {
        return TabEntity::class;
    }
}
