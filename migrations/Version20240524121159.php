<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524121159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dodatna_lica (id INT AUTO_INCREMENT NOT NULL, nosilac_osiguranja_id_id INT DEFAULT NULL, ime_prezime VARCHAR(255) NOT NULL, datum_rodjenja DATE NOT NULL, broj_pasosa VARCHAR(20) NOT NULL, INDEX IDX_C8523F82CBF921FA (nosilac_osiguranja_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nosioci_osiguranja (id INT AUTO_INCREMENT NOT NULL, ime_prezime VARCHAR(255) NOT NULL, datum_rodjenja DATE NOT NULL, broj_pasosa VARCHAR(20) NOT NULL, telefon VARCHAR(20) NOT NULL, email VARCHAR(255) DEFAULT NULL, datum_putovanja_od DATE NOT NULL, datum_putovanja_do DATE NOT NULL, vrsta_polise VARCHAR(20) DEFAULT NULL, datum_kreiranja DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dodatna_lica ADD CONSTRAINT FK_C8523F82CBF921FA FOREIGN KEY (nosilac_osiguranja_id_id) REFERENCES nosioci_osiguranja (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dodatna_lica DROP FOREIGN KEY FK_C8523F82CBF921FA');
        $this->addSql('DROP TABLE dodatna_lica');
        $this->addSql('DROP TABLE nosioci_osiguranja');
    }
}
