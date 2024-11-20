<?php

declare(strict_types=1);

namespace ProductTab\Extension\Content\Product;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;

class ProductTabEntity extends Entity
{
    protected string $productId;

    protected string $productVersionId;

    protected string $tabId;

    protected string $tabVersionId;

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    public function getProductVersionId(): string
    {
        return $this->productVersionId;
    }

    public function setProductVersionId(string $productVersionId): void
    {
        $this->productVersionId = $productVersionId;
    }

    public function getTabId(): string
    {
        return $this->tabId;
    }

    public function setTabId(string $tabId): void
    {
        $this->tabId = $tabId;
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
