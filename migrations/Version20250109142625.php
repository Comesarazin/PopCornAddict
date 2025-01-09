<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250109142625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_movie (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, movie_id INT NOT NULL, title VARCHAR(255) NOT NULL, overview LONGTEXT DEFAULT NULL, release_date VARCHAR(255) DEFAULT NULL, vote_average DOUBLE PRECISION DEFAULT NULL, vote_count INT DEFAULT NULL, runtime INT DEFAULT NULL, original_language VARCHAR(255) DEFAULT NULL, budget INT DEFAULT NULL, revenue INT DEFAULT NULL, genres LONGTEXT DEFAULT NULL, production_companies LONGTEXT DEFAULT NULL, INDEX IDX_FF9C0937A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_movie ADD CONSTRAINT FK_FF9C0937A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_movie DROP FOREIGN KEY FK_FF9C0937A76ED395');
        $this->addSql('DROP TABLE user_movie');
    }
}
