<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704090035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD id_commercants_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31685C47289A FOREIGN KEY (id_commercants_id) REFERENCES commercants (id)');
        $this->addSql('CREATE INDEX IDX_BFDD31685C47289A ON articles (id_commercants_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31685C47289A');
        $this->addSql('DROP INDEX IDX_BFDD31685C47289A ON articles');
        $this->addSql('ALTER TABLE articles DROP id_commercants_id');
    }
}
