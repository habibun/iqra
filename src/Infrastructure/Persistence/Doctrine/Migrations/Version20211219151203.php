<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211219151203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quran (id INT AUTO_INCREMENT NOT NULL, format_id INT DEFAULT NULL, type_id INT DEFAULT NULL, narration_id INT DEFAULT NULL, language_id INT DEFAULT NULL, INDEX IDX_DFE8C44BD629F605 (format_id), INDEX IDX_DFE8C44BC54C8C93 (type_id), INDEX IDX_DFE8C44B7503F876 (narration_id), INDEX IDX_DFE8C44B82F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quran_chapter (id INT AUTO_INCREMENT NOT NULL, revelation_type_id INT DEFAULT NULL, quran_id INT DEFAULT NULL, number SMALLINT NOT NULL, name VARCHAR(50) NOT NULL, english_name VARCHAR(50) NOT NULL, english_name_translation VARCHAR(50) NOT NULL, INDEX IDX_30DE4017C8511234 (revelation_type_id), INDEX IDX_30DE40171BC9DFCE (quran_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quran_chapter_revelation_type (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quran_chapter_verse (id INT AUTO_INCREMENT NOT NULL, chapter_id INT DEFAULT NULL, number SMALLINT NOT NULL, text VARCHAR(10000) NOT NULL, number_in_chapter SMALLINT NOT NULL, juz SMALLINT NOT NULL, manzil SMALLINT NOT NULL, page SMALLINT NOT NULL, ruku SMALLINT NOT NULL, hizb_quarter SMALLINT NOT NULL, sajda TINYINT(1) NOT NULL, INDEX IDX_FC0F4B53579F4768 (chapter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quran_format (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quran_language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quran_narration (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, english_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quran_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quran ADD CONSTRAINT FK_DFE8C44BD629F605 FOREIGN KEY (format_id) REFERENCES quran_format (id)');
        $this->addSql('ALTER TABLE quran ADD CONSTRAINT FK_DFE8C44BC54C8C93 FOREIGN KEY (type_id) REFERENCES quran_type (id)');
        $this->addSql('ALTER TABLE quran ADD CONSTRAINT FK_DFE8C44B7503F876 FOREIGN KEY (narration_id) REFERENCES quran_narration (id)');
        $this->addSql('ALTER TABLE quran ADD CONSTRAINT FK_DFE8C44B82F1BAF4 FOREIGN KEY (language_id) REFERENCES quran_language (id)');
        $this->addSql('ALTER TABLE quran_chapter ADD CONSTRAINT FK_30DE4017C8511234 FOREIGN KEY (revelation_type_id) REFERENCES quran_chapter_revelation_type (id)');
        $this->addSql('ALTER TABLE quran_chapter ADD CONSTRAINT FK_30DE40171BC9DFCE FOREIGN KEY (quran_id) REFERENCES quran (id)');
        $this->addSql('ALTER TABLE quran_chapter_verse ADD CONSTRAINT FK_FC0F4B53579F4768 FOREIGN KEY (chapter_id) REFERENCES quran_chapter (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quran_chapter DROP FOREIGN KEY FK_30DE40171BC9DFCE');
        $this->addSql('ALTER TABLE quran_chapter_verse DROP FOREIGN KEY FK_FC0F4B53579F4768');
        $this->addSql('ALTER TABLE quran_chapter DROP FOREIGN KEY FK_30DE4017C8511234');
        $this->addSql('ALTER TABLE quran DROP FOREIGN KEY FK_DFE8C44BD629F605');
        $this->addSql('ALTER TABLE quran DROP FOREIGN KEY FK_DFE8C44B82F1BAF4');
        $this->addSql('ALTER TABLE quran DROP FOREIGN KEY FK_DFE8C44B7503F876');
        $this->addSql('ALTER TABLE quran DROP FOREIGN KEY FK_DFE8C44BC54C8C93');
        $this->addSql('DROP TABLE quran');
        $this->addSql('DROP TABLE quran_chapter');
        $this->addSql('DROP TABLE quran_chapter_revelation_type');
        $this->addSql('DROP TABLE quran_chapter_verse');
        $this->addSql('DROP TABLE quran_format');
        $this->addSql('DROP TABLE quran_language');
        $this->addSql('DROP TABLE quran_narration');
        $this->addSql('DROP TABLE quran_type');
    }
}
