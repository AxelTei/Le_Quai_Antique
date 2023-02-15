<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230215150052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add attribute nullable in restaurant_dishes table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_menu CHANGE formula_day_title formula_day_title VARCHAR(150) DEFAULT NULL, CHANGE formula_day_description formula_day_description TEXT DEFAULT NULL, CHANGE formula_day_price formula_day_price VARCHAR(30) DEFAULT NULL, CHANGE formula_night_title formula_night_title VARCHAR(150) DEFAULT NULL, CHANGE formula_night_description formula_night_description TEXT DEFAULT NULL, CHANGE formula_night_price formula_night_price VARCHAR(30) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant_menu CHANGE formula_day_title formula_day_title VARCHAR(150) NOT NULL, CHANGE formula_day_description formula_day_description TEXT NOT NULL, CHANGE formula_day_price formula_day_price VARCHAR(30) NOT NULL, CHANGE formula_night_title formula_night_title VARCHAR(150) NOT NULL, CHANGE formula_night_description formula_night_description TEXT NOT NULL, CHANGE formula_night_price formula_night_price VARCHAR(30) NOT NULL');
    }
}
