<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230427110220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(255) NOT NULL, time VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE establishment (id INT AUTO_INCREMENT NOT NULL, establishment_type_id INT DEFAULT NULL, service_id INT DEFAULT NULL, created_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, opening VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, INDEX IDX_DBEFB1EEB86BF9B6 (establishment_type_id), INDEX IDX_DBEFB1EEED5CA9E6 (service_id), INDEX IDX_DBEFB1EEB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE establishment_calendar (establishment_id INT NOT NULL, calendar_id INT NOT NULL, INDEX IDX_25D052748565851 (establishment_id), INDEX IDX_25D05274A40A2C8 (calendar_id), PRIMARY KEY(establishment_id, calendar_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE establishment_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_type (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, time INT NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_429DE3C5ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, roles VARCHAR(255) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, last_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', phone_number VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEB86BF9B6 FOREIGN KEY (establishment_type_id) REFERENCES establishment_type (id)');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE establishment ADD CONSTRAINT FK_DBEFB1EEB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE establishment_calendar ADD CONSTRAINT FK_25D052748565851 FOREIGN KEY (establishment_id) REFERENCES establishment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE establishment_calendar ADD CONSTRAINT FK_25D05274A40A2C8 FOREIGN KEY (calendar_id) REFERENCES calendar (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_type ADD CONSTRAINT FK_429DE3C5ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEB86BF9B6');
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEED5CA9E6');
        $this->addSql('ALTER TABLE establishment DROP FOREIGN KEY FK_DBEFB1EEB03A8386');
        $this->addSql('ALTER TABLE establishment_calendar DROP FOREIGN KEY FK_25D052748565851');
        $this->addSql('ALTER TABLE establishment_calendar DROP FOREIGN KEY FK_25D05274A40A2C8');
        $this->addSql('ALTER TABLE service_type DROP FOREIGN KEY FK_429DE3C5ED5CA9E6');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE establishment');
        $this->addSql('DROP TABLE establishment_calendar');
        $this->addSql('DROP TABLE establishment_type');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_type');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
