<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230320185714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, prefered_group_number INT DEFAULT NULL, allergies VARCHAR(255) DEFAULT NULL, alias VARCHAR(180) DEFAULT NULL, phone_number VARCHAR(30) DEFAULT NULL, UNIQUE INDEX UNIQ_62534E21E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_bookings (id INT AUTO_INCREMENT NOT NULL, prefered_group_number INT NOT NULL, allergies VARCHAR(255) DEFAULT NULL, date VARCHAR(255) NOT NULL, hour_selected_day VARCHAR(255) DEFAULT NULL, hour_selected_night VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(30) DEFAULT NULL, alias VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_dishes (id INT AUTO_INCREMENT NOT NULL, dish_title VARCHAR(150) NOT NULL, dish_category VARCHAR(150) NOT NULL, dish_description TEXT NOT NULL, dish_price VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_hours (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(150) NOT NULL, opening_hours_day VARCHAR(30) DEFAULT NULL, opening_hours_night VARCHAR(30) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_places (id INT AUTO_INCREMENT NOT NULL, active_date VARCHAR(255) NOT NULL, active_hour VARCHAR(255) NOT NULL, number_of_submit INT NOT NULL, number_of_places_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant_rule (id INT AUTO_INCREMENT NOT NULL, closure_day VARCHAR(255) NOT NULL, run_midi VARCHAR(255) NOT NULL, run_soir VARCHAR(255) NOT NULL, booking_limit INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_5A8A6C8DA76ED395 ON post');
        $this->addSql('ALTER TABLE post DROP user_id, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE restaurant_bookings');
        $this->addSql('DROP TABLE restaurant_dishes');
        $this->addSql('DROP TABLE restaurant_hours');
        $this->addSql('DROP TABLE restaurant_places');
        $this->addSql('DROP TABLE restaurant_rule');
        $this->addSql('ALTER TABLE post ADD user_id INT DEFAULT NULL, CHANGE image image LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DA76ED395 ON post (user_id)');
    }
}
