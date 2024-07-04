<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704100655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes ADD id_paniers_id INT NOT NULL, ADD id_commercants_id INT NOT NULL, ADD payer TINYINT(1) NOT NULL, ADD date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C1BBF7D77 FOREIGN KEY (id_paniers_id) REFERENCES paniers (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C5C47289A FOREIGN KEY (id_commercants_id) REFERENCES commercants (id)');
        $this->addSql('CREATE INDEX IDX_35D4282C1BBF7D77 ON commandes (id_paniers_id)');
        $this->addSql('CREATE INDEX IDX_35D4282C5C47289A ON commandes (id_commercants_id)');
        $this->addSql('ALTER TABLE factures ADD id_commandes_id INT NOT NULL');
        $this->addSql('ALTER TABLE factures ADD CONSTRAINT FK_647590BA834B794 FOREIGN KEY (id_commandes_id) REFERENCES commandes (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_647590BA834B794 ON factures (id_commandes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C1BBF7D77');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C5C47289A');
        $this->addSql('DROP INDEX IDX_35D4282C1BBF7D77 ON commandes');
        $this->addSql('DROP INDEX IDX_35D4282C5C47289A ON commandes');
        $this->addSql('ALTER TABLE commandes DROP id_paniers_id, DROP id_commercants_id, DROP payer, DROP date');
        $this->addSql('ALTER TABLE factures DROP FOREIGN KEY FK_647590BA834B794');
        $this->addSql('DROP INDEX UNIQ_647590BA834B794 ON factures');
        $this->addSql('ALTER TABLE factures DROP id_commandes_id');
    }
}
