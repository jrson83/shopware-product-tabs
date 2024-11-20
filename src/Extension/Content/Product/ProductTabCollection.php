<?php

declare(strict_types=1);

namespace ProductTab\Extension\Content\Product;

use Shopware\Core\Framework\DataAbstractionLayer\EntityCollection;

/**
 * @package core
 * @method void                  add(ProductTabEntity $entity)
 * @method void                  set(string $key, ProductTabEntity $entity)
 * @method ProductTabEntity[]    getIterator()
 * @method ProductTabEntity[]    getElements()
 * @method ProductTabEntity|null get(string $key)
 * @method ProductTabEntity|null first()
 * @method ProductTabEntity|null last()
 */
class ProductTabCollection extends EntityCollection
{
    protected function getExpectedClass(): string
    {
        return ProductTabEntity::class;
    }
}
