<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230422203941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE establishment (id INT AUTO_INCREMENT NOT NULL, etablissement_type_id INT DEFAULT NULL, service_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, ouverture VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, phonenumber VARCHAR(255) DEFAULT NULL, INDEX IDX_DBEFB1EEC15D9350 (etablissement_type_id), INDEX IDX_DBEFB1EEED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE establishment_calendar (establishment_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_25D052748565851 (establishment_id), INDEX IDX_25D05274A40A2C8 (calendar_id), PRIMARY KEY(establishment_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE establishment_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEC15D9350 FOREIGN KEY (etablissement_type_id) REFERENCES establishment_type (id)');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE establishment_calendar ADD CONSTRAINT FK_25D052748565851 FOREIGN KEY (establishment_id) REFERENCES establishment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE establishment_calendar ADD CONSTRAINT FK_25D05274A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_calendar DROP FOREIGN KEY FK_6CC02353A40A2C8');
        $this->addSql('ALTER TABLE etablissement_calendar DROP FOREIGN KEY FK_6CC02353FF631228');
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CED5CA9E6');
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CF646BD96');
        $this->addSql('DROP TABLE etablissementtype');
        $this->addSql('DROP TABLE etablissement_calendar');
        $this->addSql('DROP TABLE etablissement');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etablissementtype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etablissement_calendar (etablissement_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_6CC02353FF631228 (etablissement_id), INDEX IDX_6CC02353A40A2C8 (calendar_id), PRIMARY KEY(etablissement_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etablissement (id INT AUTO_INCREMENT NOT NULL, etablissementtype_id INT DEFAULT NULL, service_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ouverture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phonenumber VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_20FD592CF646BD96 (etablissementtype_id), INDEX IDX_20FD592CED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE etablissement_calendar ADD CONSTRAINT FK_6CC02353A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_calendar ADD CONSTRAINT FK_6CC02353FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissement (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CF646BD96 FOREIGN KEY (etablissementtype_id) REFERENCES etablissementtype (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEC15D9350');
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEED5CA9E6');
        $this->addSql('ALTER TABLE establishment_calendar DROP FOREIGN KEY FK_25D052748565851');
        $this->addSql('ALTER TABLE establishment_calendar DROP FOREIGN KEY FK_25D05274A40A2C8');
        $this->addSql('DROP TABLE establishment');
        $this->addSql('DROP TABLE establishment_calendar');
        $this->addSql('DROP TABLE establishment_type');
    }
}
