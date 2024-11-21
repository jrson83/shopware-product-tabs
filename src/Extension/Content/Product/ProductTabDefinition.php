<?php

declare(strict_types=1);

namespace ProductTab\Extension\Content\Product;

use ProductTab\Core\Content\Tab\TabDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ReferenceVersionField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\MappingEntityDefinition;

class ProductTabDefinition extends MappingEntityDefinition
{
    final public const ENTITY_NAME = 'product_tab';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getCollectionClass(): string
    {
        return ProductTabCollection::class;
    }

    public function getEntityClass(): string
    {
        return ProductTabEntity::class;
    }

    public function isVersionAware(): bool
    {
        return true;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('product_id', 'productId', ProductDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new ReferenceVersionField(ProductDefinition::class))->addFlags(new PrimaryKey(), new Required()),

            (new FkField('tab_id', 'tabId', TabDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new ReferenceVersionField(TabDefinition::class))->addFlags(new PrimaryKey(), new Required()),

            new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class, 'id', false),
            new ManyToOneAssociationField('tab', 'tab_id', TabDefinition::class, 'id', false),
        ]);
    }
}
