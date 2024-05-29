<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529144413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dodatna_lica DROP FOREIGN KEY FK_C8523F82CBF921FA');
        $this->addSql('DROP INDEX IDX_C8523F82CBF921FA ON dodatna_lica');
        $this->addSql('ALTER TABLE dodatna_lica CHANGE nosilac_osiguranja_id_id nosilac_osiguranja_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dodatna_lica ADD CONSTRAINT FK_C8523F82D5B294CB FOREIGN KEY (nosilac_osiguranja_id) REFERENCES nosioci_osiguranja (id)');
        $this->addSql('CREATE INDEX IDX_C8523F82D5B294CB ON dodatna_lica (nosilac_osiguranja_id)');
        $this->addSql('ALTER TABLE nosioci_osiguranja CHANGE datum_kreiranja datum_kreiranja DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dodatna_lica DROP FOREIGN KEY FK_C8523F82D5B294CB');
        $this->addSql('DROP INDEX IDX_C8523F82D5B294CB ON dodatna_lica');
        $this->addSql('ALTER TABLE dodatna_lica CHANGE nosilac_osiguranja_id nosilac_osiguranja_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dodatna_lica ADD CONSTRAINT FK_C8523F82CBF921FA FOREIGN KEY (nosilac_osiguranja_id_id) REFERENCES nosioci_osiguranja (id)');
        $this->addSql('CREATE INDEX IDX_C8523F82CBF921FA ON dodatna_lica (nosilac_osiguranja_id_id)');
        $this->addSql('ALTER TABLE nosioci_osiguranja CHANGE datum_kreiranja datum_kreiranja DATETIME DEFAULT CURRENT_TIMESTAMP');
    }
}
