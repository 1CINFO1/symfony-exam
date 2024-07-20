<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240720134923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Categorie CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE Produit CHANGE categorie_id categorie_id INT NOT NULL, CHANGE `like` `like` INT DEFAULT 0 NOT NULL, CHANGE date_fa date_fa DATETIME NOT NULL');
        $this->addSql('ALTER TABLE Produit RENAME INDEX categorie_id TO IDX_29A5EC27BCF5E72D');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE description description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE produit CHANGE categorie_id categorie_id INT DEFAULT NULL, CHANGE `like` `like` INT DEFAULT 0, CHANGE date_fa date_fa DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE produit RENAME INDEX idx_29a5ec27bcf5e72d TO categorie_id');
    }
}
