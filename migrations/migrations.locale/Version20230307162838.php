<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307162838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'change nullable true in false for date attribute and alias attribute in book table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings CHANGE date date VARCHAR(255) NOT NULL, CHANGE alias alias VARCHAR(180) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings CHANGE date date VARCHAR(255) DEFAULT NULL, CHANGE alias alias VARCHAR(180) DEFAULT NULL');
    }
}
