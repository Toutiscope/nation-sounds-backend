<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204122207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restauration ADD CONSTRAINT FK_898B1EF112469DE2 FOREIGN KEY (category_id) REFERENCES poi_category (id)');
        $this->addSql('CREATE INDEX IDX_898B1EF112469DE2 ON restauration (category_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restauration DROP FOREIGN KEY FK_898B1EF112469DE2');
        $this->addSql('DROP INDEX IDX_898B1EF112469DE2 ON restauration');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }
}
