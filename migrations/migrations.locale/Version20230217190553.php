<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217190553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'change I hope the last time, the attribute of Book.php to match with BookType.php';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings CHANGE prefered_hour prefered_hour VARCHAR(255) NOT NULL, CHANGE prefered_group_number prefered_group_number INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings CHANGE prefered_hour prefered_hour LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE prefered_group_number prefered_group_number LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
