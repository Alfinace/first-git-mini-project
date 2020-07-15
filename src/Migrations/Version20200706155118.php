<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200706155118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bon_sortant (id INT AUTO_INCREMENT NOT NULL, materiel_id INT NOT NULL, personnel_id INT NOT NULL, quantite INT NOT NULL, pack INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FD1ADBF216880AAF (materiel_id), INDEX IDX_FD1ADBF21C109075 (personnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bon_sortant ADD CONSTRAINT FK_FD1ADBF216880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE bon_sortant ADD CONSTRAINT FK_FD1ADBF21C109075 FOREIGN KEY (personnel_id) REFERENCES personnel (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE personnel CHANGE fonction_id fonction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bon_entrant CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE bon_sortant');
        $this->addSql('ALTER TABLE bon_entrant CHANGE fournisseur_id fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personnel CHANGE fonction_id fonction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
