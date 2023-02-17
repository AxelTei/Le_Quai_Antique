<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217212637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove two columns from restaurant_bookings table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings DROP formula_day, DROP formula_night');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings ADD formula_day TINYINT(1) NOT NULL, ADD formula_night TINYINT(1) NOT NULL');
    }
}
