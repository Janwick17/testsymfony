<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241023180700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE market ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE market ADD CONSTRAINT FK_6BAC85CB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_6BAC85CB19EB6921 ON market (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE market DROP FOREIGN KEY FK_6BAC85CB19EB6921');
        $this->addSql('DROP INDEX IDX_6BAC85CB19EB6921 ON market');
        $this->addSql('ALTER TABLE market DROP client_id');
    }
}