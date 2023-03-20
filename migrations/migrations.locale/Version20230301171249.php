<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301171249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new columns in restaurant_bookings and customers table and create new table restaurant_places';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE restaurant_places (id INT AUTO_INCREMENT NOT NULL, number_of_tables_available INT NOT NULL, booking_date VARCHAR(255) NOT NULL, booking_hour_day VARCHAR(255) DEFAULT NULL, booking_hour_night VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customers ADD phone_number VARCHAR(30) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant_bookings ADD phone_number VARCHAR(30) DEFAULT NULL, ADD alias VARCHAR(180) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE restaurant_places');
        $this->addSql('ALTER TABLE customers DROP phone_number');
        $this->addSql('ALTER TABLE restaurant_bookings DROP phone_number, DROP alias');
    }
}
