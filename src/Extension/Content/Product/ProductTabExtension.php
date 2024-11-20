<?php

declare(strict_types=1);

namespace ProductTab\Extension\Content\Product;

use ProductTab\Core\Content\Tab\TabDefinition;
use ProductTab\Extension\Content\Product\ProductTabDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\CascadeDelete;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Inherited;

class ProductTabExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            (new ManyToManyAssociationField(
                'tabs',
                TabDefinition::class,
                ProductTabDefinition::class,
                'product_id',
                'tab_id'
            ))->addFlags(new ApiAware(), new CascadeDelete(), new Inherited()),
        );
    }

    public function getDefinitionClass(): string
    {
        return ProductDefinition::class;
    }
}
