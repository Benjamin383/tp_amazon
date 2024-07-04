<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704134815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paniers DROP FOREIGN KEY FK_489990369CA7F675');
        $this->addSql('DROP TABLE visiteurs');
        $this->addSql('ALTER TABLE commercants ADD id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commercants ADD CONSTRAINT FK_66E5E59C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66E5E59C79F37AE5 ON commercants (id_user_id)');
        $this->addSql('DROP INDEX UNIQ_489990369CA7F675 ON paniers');
        $this->addSql('ALTER TABLE paniers CHANGE id_visiteurs_id id_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE paniers ADD CONSTRAINT FK_4899903679F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4899903679F37AE5 ON paniers (id_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE visiteurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE paniers DROP FOREIGN KEY FK_4899903679F37AE5');
        $this->addSql('DROP INDEX UNIQ_4899903679F37AE5 ON paniers');
        $this->addSql('ALTER TABLE paniers CHANGE id_user_id id_visiteurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE paniers ADD CONSTRAINT FK_489990369CA7F675 FOREIGN KEY (id_visiteurs_id) REFERENCES visiteurs (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_489990369CA7F675 ON paniers (id_visiteurs_id)');
        $this->addSql('ALTER TABLE commercants DROP FOREIGN KEY FK_66E5E59C79F37AE5');
        $this->addSql('DROP INDEX UNIQ_66E5E59C79F37AE5 ON commercants');
        $this->addSql('ALTER TABLE commercants DROP id_user_id');
    }
}
