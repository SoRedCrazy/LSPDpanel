<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315202151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE armes (id INT AUTO_INCREMENT NOT NULL, citoyen_id INT NOT NULL, numero_de_serie VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_32CF26E043787BBA (citoyen_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE armes ADD CONSTRAINT FK_32CF26E043787BBA FOREIGN KEY (citoyen_id) REFERENCES citoyen (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE armes DROP FOREIGN KEY FK_32CF26E043787BBA');
        $this->addSql('DROP TABLE armes');
    }
}
