<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221227212952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent CHANGE updated_at updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE plainte ADD image_name VARCHAR(255) NOT NULL, ADD image_size INT NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE rapport ADD image_name VARCHAR(255) NOT NULL, ADD image_size INT NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agent CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE plainte DROP image_name, DROP image_size, DROP updated_at');
        $this->addSql('ALTER TABLE rapport DROP image_name, DROP image_size, DROP updated_at');
    }
}
