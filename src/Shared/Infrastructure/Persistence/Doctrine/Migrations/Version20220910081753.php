<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220910081753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert Predefined Data';
    }

    public function up(Schema $schema): void
    {
        $path = __DIR__.'/../Sql';
        $files = array_values(array_filter(scandir($path), function ($file) use ($path) {
            return !is_dir($path.'/'.$file);
        }));

        foreach ($files as $file) {
            foreach (explode(';', file_get_contents(__DIR__.'./../Sql/'.$file)) as $sql) {
                if (1 === strlen($sql)) {
                    continue;
                }

                $this->addSql($sql);
            }
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE language_translation');
    }
}
