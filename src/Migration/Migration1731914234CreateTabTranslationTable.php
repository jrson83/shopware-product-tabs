<?php

declare(strict_types=1);

namespace ProductTab\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;

class Migration1731914234CreateTabTranslationTable extends MigrationStep
{
    public function getCreationTimestamp(): int
    {
        return 1731625480;
    }

    public function update(Connection $connection): void
    {
        $query = <<<SQL
CREATE TABLE `tab_translation` (
    `name` VARCHAR(255) NOT NULL,
    `content` LONGTEXT NOT NULL,
    `created_at` DATETIME(3) NOT NULL,
    `updated_at` DATETIME(3) NULL,
    `tab_id` BINARY(16) NOT NULL,
    `language_id` BINARY(16) NOT NULL,
    `tab_version_id` BINARY(16) NOT NULL,
    PRIMARY KEY (`tab_id`,`language_id`,`tab_version_id`),
    KEY `fk.tab_translation.tab_id` (`tab_id`,`tab_version_id`),
    KEY `fk.tab_translation.language_id` (`language_id`),
    CONSTRAINT `fk.tab_translation.tab_id` FOREIGN KEY (`tab_id`,`tab_version_id`)
    REFERENCES `tab` (`id`,`version_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk.tab_translation.language_id` FOREIGN KEY (`language_id`)
    REFERENCES `language` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
    ENGINE = InnoDB
    DEFAULT CHARSET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;
SQL;
        $connection->executeStatement($query);
    }
}
