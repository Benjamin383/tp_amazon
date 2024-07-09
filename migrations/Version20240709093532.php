<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240709093532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31685C47289A');
        $this->addSql('DROP INDEX IDX_BFDD31685C47289A ON articles');
        $this->addSql('ALTER TABLE articles CHANGE id_commercants_id commercant_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316883FA6DD0 FOREIGN KEY (commercant_id) REFERENCES commercants (id)');
        $this->addSql('CREATE INDEX IDX_BFDD316883FA6DD0 ON articles (commercant_id)');
        $this->addSql('ALTER TABLE commercants CHANGE id_user_id id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64983FA6DD0');
        $this->addSql('DROP INDEX UNIQ_8D93D64983FA6DD0 ON user');
        $this->addSql('ALTER TABLE user DROP commercant_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316883FA6DD0');
        $this->addSql('DROP INDEX IDX_BFDD316883FA6DD0 ON articles');
        $this->addSql('ALTER TABLE articles CHANGE commercant_id id_commercants_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31685C47289A FOREIGN KEY (id_commercants_id) REFERENCES commercants (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BFDD31685C47289A ON articles (id_commercants_id)');
        $this->addSql('ALTER TABLE commercants CHANGE id_user_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD commercant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64983FA6DD0 FOREIGN KEY (commercant_id) REFERENCES commercants (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64983FA6DD0 ON user (commercant_id)');
    }
}
