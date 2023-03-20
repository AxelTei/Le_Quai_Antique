<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213181150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Change User table in Customers and add Menu table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DC3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        // $this->addSql('CREATE INDEX IDX_5A8A6C8DC3568B40 ON post (customers_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DC3568B40');
        $this->addSql('DROP INDEX IDX_5A8A6C8DC3568B40 ON post');
    }
}
