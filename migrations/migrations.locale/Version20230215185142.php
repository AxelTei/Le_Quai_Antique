<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215185142 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add new attribute to customers table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers ADD prefered_hour VARCHAR(255) DEFAULT NULL, ADD prefered_group_number INT DEFAULT NULL, ADD allergies VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers DROP prefered_hour, DROP prefered_group_number, DROP allergies');
    }
}
