<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301184734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'delete relation between Customers table and restaurant_bookings';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings DROP FOREIGN KEY FK_5A20F2DAD4721F51');
        $this->addSql('DROP INDEX IDX_5A20F2DAD4721F51 ON restaurant_bookings');
        $this->addSql('ALTER TABLE restaurant_bookings DROP customers_email');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_bookings ADD customers_email VARCHAR(180) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant_bookings ADD CONSTRAINT FK_5A20F2DAD4721F51 FOREIGN KEY (customers_email) REFERENCES customers (email) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_5A20F2DAD4721F51 ON restaurant_bookings (customers_email)');
    }
}
