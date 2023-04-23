<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230422205033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEC15D9350');
        $this->addSql('DROP INDEX IDX_DBEFB1EEC15D9350 ON establishment');
        $this->addSql('ALTER TABLE establishment CHANGE etablissement_type_id establishment_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEB86BF9B6 FOREIGN KEY (establishment_type_id) REFERENCES establishment_type (id)');
        $this->addSql('CREATE INDEX IDX_DBEFB1EEB86BF9B6 ON establishment (establishment_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEB86BF9B6');
        $this->addSql('DROP INDEX IDX_DBEFB1EEB86BF9B6 ON establishment');
        $this->addSql('ALTER TABLE establishment CHANGE establishment_type_id etablissement_type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEC15D9350 FOREIGN KEY (etablissement_type_id) REFERENCES establishment_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DBEFB1EEC15D9350 ON establishment (etablissement_type_id)');
    }
}
