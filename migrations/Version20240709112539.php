<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240709112539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, commercant_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, url_image VARCHAR(255) DEFAULT NULL, INDEX IDX_BFDD316883FA6DD0 (commercant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, id_paniers_id INT NOT NULL, id_commercants_id INT NOT NULL, payer TINYINT(1) NOT NULL, date DATETIME NOT NULL, INDEX IDX_35D4282C1BBF7D77 (id_paniers_id), INDEX IDX_35D4282C5C47289A (id_commercants_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commercants (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_66E5E59C79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE factures (id INT AUTO_INCREMENT NOT NULL, id_commandes_id INT NOT NULL, montant INT NOT NULL, UNIQUE INDEX UNIQ_647590BA834B794 (id_commandes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paniers (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, UNIQUE INDEX UNIQ_4899903679F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paniers_articles (id INT AUTO_INCREMENT NOT NULL, id_paniers_id INT DEFAULT NULL, id_articles_id INT NOT NULL, quantite INT NOT NULL, deja_payer TINYINT(1) NOT NULL, INDEX IDX_7AEDC24F1BBF7D77 (id_paniers_id), INDEX IDX_7AEDC24F6A83B3B (id_articles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD316883FA6DD0 FOREIGN KEY (commercant_id) REFERENCES commercants (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C1BBF7D77 FOREIGN KEY (id_paniers_id) REFERENCES paniers (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C5C47289A FOREIGN KEY (id_commercants_id) REFERENCES commercants (id)');
        $this->addSql('ALTER TABLE commercants ADD CONSTRAINT FK_66E5E59C79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590BA834B794 FOREIGN KEY (id_commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE paniers ADD CONSTRAINT FK_4899903679F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE paniers_articles ADD CONSTRAINT FK_7AEDC24F1BBF7D77 FOREIGN KEY (id_paniers_id) REFERENCES paniers (id)');
        $this->addSql('ALTER TABLE paniers_articles ADD CONSTRAINT FK_7AEDC24F6A83B3B FOREIGN KEY (id_articles_id) REFERENCES articles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD316883FA6DD0');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C1BBF7D77');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C5C47289A');
        $this->addSql('ALTER TABLE commercants DROP FOREIGN KEY FK_66E5E59C79F37AE5');
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590BA834B794');
        $this->addSql('ALTER TABLE paniers DROP FOREIGN KEY FK_4899903679F37AE5');
        $this->addSql('ALTER TABLE paniers_articles DROP FOREIGN KEY FK_7AEDC24F1BBF7D77');
        $this->addSql('ALTER TABLE paniers_articles DROP FOREIGN KEY FK_7AEDC24F6A83B3B');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE commercants');
        $this->addSql('DROP TABLE factures');
        $this->addSql('DROP TABLE paniers');
        $this->addSql('DROP TABLE paniers_articles');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
