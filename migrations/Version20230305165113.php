<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230305165113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create table restaurant_rule with makerbundle';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE restaurant_rule (id INT AUTO_INCREMENT NOT NULL, closure_day VARCHAR(255) NOT NULL, run_midi VARCHAR(255) NOT NULL, run_soir VARCHAR(255) NOT NULL, booking_limit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE restaurant_rule');
    }
}
