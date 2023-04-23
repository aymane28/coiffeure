<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220918165400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, begin_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coiffeur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissements (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, ouverture VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, phonenumber VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement_service (etablissement_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_E58C8511FF631228 (etablissement_id), INDEX IDX_E58C8511ED5CA9E6 (service_id), PRIMARY KEY(etablissement_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement_calendar (etablissement_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_6CC02353FF631228 (etablissement_id), INDEX IDX_6CC02353A40A2C8 (calendar_id), PRIMARY KEY(etablissement_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servicetype (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, time INT NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_E3E53DA4ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, roles VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etablissement_service ADD CONSTRAINT FK_E58C8511FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_service ADD CONSTRAINT FK_E58C8511ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_calendar ADD CONSTRAINT FK_6CC02353FF631228 FOREIGN KEY (etablissement_id) REFERENCES etablissements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_calendar ADD CONSTRAINT FK_6CC02353A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE servicetype ADD CONSTRAINT FK_E3E53DA4ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE salon_calendar DROP FOREIGN KEY FK_13EA6BBE4C91BDE4');
        $this->addSql('ALTER TABLE salon_calendar DROP FOREIGN KEY FK_13EA6BBEA40A2C8');
        $this->addSql('ALTER TABLE salon_service DROP FOREIGN KEY FK_A5C9D35D4C91BDE4');
        $this->addSql('ALTER TABLE salon_service DROP FOREIGN KEY FK_A5C9D35DED5CA9E6');
        $this->addSql('DROP TABLE etablissementtype');
        $this->addSql('DROP TABLE establishment');
        $this->addSql('DROP TABLE salon_calendar');
        $this->addSql('DROP TABLE salon_service');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etablissementtype (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE establishment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ouverture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, phonenumber VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE salon_calendar (salon_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_13EA6BBE4C91BDE4 (salon_id), INDEX IDX_13EA6BBEA40A2C8 (calendar_id), PRIMARY KEY(salon_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE salon_service (salon_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_A5C9D35D4C91BDE4 (salon_id), INDEX IDX_A5C9D35DED5CA9E6 (service_id), PRIMARY KEY(salon_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE salon_calendar ADD CONSTRAINT FK_13EA6BBE4C91BDE4 FOREIGN KEY (salon_id) REFERENCES establishment (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salon_calendar ADD CONSTRAINT FK_13EA6BBEA40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salon_service ADD CONSTRAINT FK_A5C9D35D4C91BDE4 FOREIGN KEY (salon_id) REFERENCES establishment (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salon_service ADD CONSTRAINT FK_A5C9D35DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etablissement_service DROP FOREIGN KEY FK_E58C8511FF631228');
        $this->addSql('ALTER TABLE etablissement_service DROP FOREIGN KEY FK_E58C8511ED5CA9E6');
        $this->addSql('ALTER TABLE etablissement_calendar DROP FOREIGN KEY FK_6CC02353FF631228');
        $this->addSql('ALTER TABLE etablissement_calendar DROP FOREIGN KEY FK_6CC02353A40A2C8');
        $this->addSql('ALTER TABLE servicetype DROP FOREIGN KEY FK_E3E53DA4ED5CA9E6');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE coiffeur');
        $this->addSql('DROP TABLE etablissements');
        $this->addSql('DROP TABLE etablissement_service');
        $this->addSql('DROP TABLE etablissement_calendar');
        $this->addSql('DROP TABLE servicetype');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
