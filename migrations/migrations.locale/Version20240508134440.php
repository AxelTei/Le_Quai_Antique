<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508134440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_places ADD book_id INT NOT NULL');
        $this->addSql('ALTER TABLE restaurant_places ADD CONSTRAINT FK_F3193A416A2B381 FOREIGN KEY (book_id) REFERENCES restaurant_bookings (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F3193A416A2B381 ON restaurant_places (book_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_places DROP FOREIGN KEY FK_F3193A416A2B381');
        $this->addSql('DROP INDEX UNIQ_F3193A416A2B381 ON restaurant_places');
        $this->addSql('ALTER TABLE restaurant_places DROP book_id');
    }
}
