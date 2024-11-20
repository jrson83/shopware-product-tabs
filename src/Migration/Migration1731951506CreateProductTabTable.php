<?php

declare(strict_types=1);

namespace ProductTab\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;

class Migration1731951506CreateProductTabTable extends MigrationStep
{
    use InheritanceUpdaterTrait;

    public function getCreationTimestamp(): int
    {
        return 1731625480;
    }

    public function update(Connection $connection): void
    {
        $query = <<<SQL
CREATE TABLE `product_tab` (
    `product_id` BINARY(16) NOT NULL,
    `product_version_id` BINARY(16) NOT NULL,
    `tab_id` BINARY(16) NOT NULL,
    `tab_version_id` BINARY(16) NOT NULL,
    PRIMARY KEY (`product_id`,`product_version_id`,`tab_id`,`tab_version_id`),
    KEY `fk.product_tab.product_id` (`product_id`,`product_version_id`),
    KEY `fk.product_tab.tab_id` (`tab_id`,`tab_version_id`),
    CONSTRAINT `fk.product_tab.product_id` FOREIGN KEY (`product_id`,`product_version_id`)
    REFERENCES `product` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk.product_tab.tab_id` FOREIGN KEY (`tab_id`,`tab_version_id`)
    REFERENCES `tab` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;
SQL;
        $connection->executeStatement($query);

        $this->updateInheritance($connection, 'product', 'tabs');
    }
}
