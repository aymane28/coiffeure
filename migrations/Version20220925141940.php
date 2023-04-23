<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220925141940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement_service DROP FOREIGN KEY FK_E58C8511ED5CA9E6');
        $this->addSql('ALTER TABLE etablissement_service DROP FOREIGN KEY FK_E58C8511FF631228');
        $this->addSql('DROP TABLE etablissement_service');
        $this->addSql('ALTER TABLE establishment ADD service_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_20FD592CED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('CREATE INDEX IDX_20FD592CED5CA9E6 ON establishment (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etablissement_service (etablissement_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_E58C8511ED5CA9E6 (service_id), INDEX IDX_E58C8511FF631228 (etablissement_id), PRIMARY KEY(etablissement_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE etablissement_service ADD CONSTRAINT FK_E58C8511ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_service ADD CONSTRAINT FK_E58C8511FF631228 FOREIGN KEY (etablissement_id) REFERENCES establishment (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_20FD592CED5CA9E6');
        $this->addSql('DROP INDEX IDX_20FD592CED5CA9E6 ON establishment');
        $this->addSql('ALTER TABLE establishment DROP service_id');
    }
}
