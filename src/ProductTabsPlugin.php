<?php

declare(strict_types=1);

namespace ProductTab;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\DataAbstractionLayer\Indexing\EntityIndexerRegistry;

class ProductTabsPlugin extends Plugin
{
    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }

        /** @var Connection $connection */
        $connection = $this->container->get(Connection::class);
        $connection->executeStatement('DROP TABLE IF EXISTS `product_tab`;');
        $connection->executeStatement('DROP TABLE IF EXISTS `tab_translation`;');
        $connection->executeStatement('DROP TABLE IF EXISTS `tab`;');
        $connection->executeStatement('ALTER TABLE `product` DROP COLUMN `tabs`;');
    }

    public function activate(ActivateContext $activateContext): void
    {
        $entityIndexerRegistry = $this->container->get(EntityIndexerRegistry::class);
        $entityIndexerRegistry->sendIndexingMessage(['product.indexer']);
    }
}
