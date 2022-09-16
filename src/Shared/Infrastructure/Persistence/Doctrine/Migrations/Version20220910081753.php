<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Version20220910081753.
 */
final class Version20220910081753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert Predefined Data';
    }

    /**
     * @psalm-suppress PossiblyInvalidMethodCall
     */
    public function up(Schema $schema): void
    {
        $this->connection->getNativeConnection()->exec(file_get_contents(__DIR__.'./../Sql/postgres.sql'));
    }

    public function down(Schema $schema): void
    {
    }
}
