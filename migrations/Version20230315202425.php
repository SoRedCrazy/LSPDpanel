<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230315202425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE armes ADD agent_id INT NOT NULL');
        $this->addSql('ALTER TABLE armes ADD CONSTRAINT FK_32CF26E03414710B FOREIGN KEY (agent_id) REFERENCES agent (id)');
        $this->addSql('CREATE INDEX IDX_32CF26E03414710B ON armes (agent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE armes DROP FOREIGN KEY FK_32CF26E03414710B');
        $this->addSql('DROP INDEX IDX_32CF26E03414710B ON armes');
        $this->addSql('ALTER TABLE armes DROP agent_id');
    }
}
