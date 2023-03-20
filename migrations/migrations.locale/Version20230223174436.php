<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223174436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add 3 new columns to restaurant_bookings';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings ADD date VARCHAR(255) NOT NULL, ADD hour_selected_day VARCHAR(255) DEFAULT NULL, ADD hour_selected_night VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings DROP date, DROP hour_selected_day, DROP hour_selected_night');
    }
}
