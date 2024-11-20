<?php

declare(strict_types=1);

namespace ProductTab\Core\Content\Tab\Aggregate\TabTranslation;

use ProductTab\Core\Content\Tab\TabDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\EntityTranslationDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\AllowHtml;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\ApiAware;

class TabTranslationDefinition extends EntityTranslationDefinition
{
    public const ENTITY_NAME = 'tab_translation';

    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    public function getEntityClass(): string
    {
        return TabTranslationEntity::class;
    }

    public function getCollectionClass(): string
    {
        return TabTranslationCollection::class;
    }

    public function getParentDefinitionClass(): string
    {
        return TabDefinition::class;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new StringField('name', 'name'))->addFlags(new ApiAware(), new Required()),
            (new LongTextField('content', 'content'))->addFlags(new ApiAware(), new Required(), new AllowHtml()),
        ]);
    }
}
