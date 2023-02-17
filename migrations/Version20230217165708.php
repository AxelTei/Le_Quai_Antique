<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217165708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add restaurant_bookings table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE restaurant_bookings (id INT AUTO_INCREMENT NOT NULL, customers_id INT DEFAULT NULL, date VARCHAR(150) NOT NULL, prefered_hour VARCHAR(30) NOT NULL, formula_day TINYINT(1) NOT NULL, formula_night TINYINT(1) NOT NULL, prefered_group_number VARCHAR(255) NOT NULL, INDEX IDX_5A20F2DAC3568B40 (customers_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE restaurant_bookings ADD CONSTRAINT FK_5A20F2DAC3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings DROP FOREIGN KEY FK_5A20F2DAC3568B40');
        $this->addSql('DROP TABLE restaurant_bookings');
    }
}
