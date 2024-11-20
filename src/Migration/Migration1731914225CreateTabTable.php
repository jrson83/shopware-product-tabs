<?php

declare(strict_types=1);

namespace ProductTab\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1731914225CreateTabTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1731625480;
    }

    public function update(Connection $connection): void
    {
        $query = <<<SQL
CREATE TABLE `tab` (
    `id` BINARY(16) NOT NULL,
    `version_id` BINARY(16) NOT NULL,
    `parent_id` BINARY(16) NULL,
    `parent_version_id` BINARY(16) NOT NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    PRIMARY KEY (`id`,`version_id`),
    KEY `fk.tab.parent_id` (`parent_id`,`version_id`),
    CONSTRAINT `fk.tab.parent_id` FOREIGN KEY (`parent_id`,`version_id`)
    REFERENCES `tab` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;
SQL;
        $connection->executeStatement($query);
    }
}
