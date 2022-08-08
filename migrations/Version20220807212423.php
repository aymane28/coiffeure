<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220807212423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE salon_service (salon_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_A5C9D35D4C91BDE4 (salon_id), INDEX IDX_A5C9D35DED5CA9E6 (service_id), PRIMARY KEY(salon_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, coupe VARCHAR(255) DEFAULT NULL, soins VARCHAR(255) DEFAULT NULL, coloration VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE salon_service ADD CONSTRAINT FK_A5C9D35D4C91BDE4 FOREIGN KEY (salon_id) REFERENCES salon (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salon_service ADD CONSTRAINT FK_A5C9D35DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salon_service DROP FOREIGN KEY FK_A5C9D35DED5CA9E6');
        $this->addSql('DROP TABLE salon_service');
        $this->addSql('DROP TABLE service');
    }
}
