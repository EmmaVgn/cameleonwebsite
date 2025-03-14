<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250314093913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_translation (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, locale VARCHAR(10) NOT NULL, name VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_2EEA2F087294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_translation (id INT AUTO_INCREMENT NOT NULL, tag_id INT NOT NULL, locale VARCHAR(10) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A8A03F8FBAD26311 (tag_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_translation ADD CONSTRAINT FK_2EEA2F087294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE tag_translation ADD CONSTRAINT FK_A8A03F8FBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_translation DROP FOREIGN KEY FK_2EEA2F087294869C');
        $this->addSql('ALTER TABLE tag_translation DROP FOREIGN KEY FK_A8A03F8FBAD26311');
        $this->addSql('DROP TABLE article_translation');
        $this->addSql('DROP TABLE tag_translation');
    }
}
