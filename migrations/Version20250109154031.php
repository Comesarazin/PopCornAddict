<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250109154031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_tv_show (id INT AUTO_INCREMENT NOT NULL, tv_show_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, overview LONGTEXT NOT NULL, first_air_date VARCHAR(255) NOT NULL, vote_average DOUBLE PRECISION NOT NULL, vote_count INT NOT NULL, number_of_seasons INT NOT NULL, number_of_episodes INT NOT NULL, original_language VARCHAR(255) NOT NULL, genres JSON NOT NULL, production_companies JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tv_show_user (user_tv_show_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_35B051B7F95DF357 (user_tv_show_id), INDEX IDX_35B051B7A76ED395 (user_id), PRIMARY KEY(user_tv_show_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_tv_show_user ADD CONSTRAINT FK_35B051B7F95DF357 FOREIGN KEY (user_tv_show_id) REFERENCES user_tv_show (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tv_show_user ADD CONSTRAINT FK_35B051B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_tv_show_user DROP FOREIGN KEY FK_35B051B7F95DF357');
        $this->addSql('ALTER TABLE user_tv_show_user DROP FOREIGN KEY FK_35B051B7A76ED395');
        $this->addSql('DROP TABLE user_tv_show');
        $this->addSql('DROP TABLE user_tv_show_user');
    }
}
