<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220918172009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etablissementtype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etablissement ADD etablissementtype_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CF646BD96 FOREIGN KEY (etablissementtype_id) REFERENCES etablissementtype (id)');
        $this->addSql('CREATE INDEX IDX_20FD592CF646BD96 ON etablissement (etablissementtype_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CF646BD96');
        $this->addSql('DROP TABLE etablissementtype');
        $this->addSql('DROP INDEX IDX_20FD592CF646BD96 ON etablissement');
        $this->addSql('ALTER TABLE etablissement DROP etablissementtype_id');
    }
}
