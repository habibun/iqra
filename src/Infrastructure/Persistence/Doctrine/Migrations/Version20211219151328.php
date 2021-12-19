<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211219151328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO quran_chapter_revelation_type (id, name) VALUES (1, "meccan"), (2, "medinan")');
        $this->addSql('INSERT INTO quran_format (id, name) VALUES (1, "text"), (2, "audio")');
        $this->addSql('INSERT INTO quran_language (id, name) VALUES (1, "arabic"), (2, "english"), (3, "bengali")');
        $this->addSql('INSERT INTO quran_type (id, name) VALUES (1, "tafsir"), (2, "translation"), (3, "quran"), (3, "transliteration"), (3, "versebyverse")');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
