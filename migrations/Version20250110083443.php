<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250110083443 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_tv_show_user DROP FOREIGN KEY FK_35B051B7A76ED395');
        $this->addSql('ALTER TABLE user_tv_show_user DROP FOREIGN KEY FK_35B051B7F95DF357');
        $this->addSql('DROP TABLE user_tv_show_user');
        $this->addSql('ALTER TABLE user_tv_show ADD user_id INT NOT NULL, CHANGE tv_show_id tv_show_id INT NOT NULL, CHANGE overview overview LONGTEXT DEFAULT NULL, CHANGE first_air_date first_air_date VARCHAR(255) DEFAULT NULL, CHANGE vote_average vote_average DOUBLE PRECISION DEFAULT NULL, CHANGE vote_count vote_count INT DEFAULT NULL, CHANGE number_of_seasons number_of_seasons INT DEFAULT NULL, CHANGE number_of_episodes number_of_episodes INT DEFAULT NULL, CHANGE original_language original_language VARCHAR(255) DEFAULT NULL, CHANGE genres genres JSON DEFAULT NULL, CHANGE production_companies production_companies JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE user_tv_show ADD CONSTRAINT FK_A9348597A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A9348597A76ED395 ON user_tv_show (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_tv_show_user (user_tv_show_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_35B051B7A76ED395 (user_id), INDEX IDX_35B051B7F95DF357 (user_tv_show_id), PRIMARY KEY(user_tv_show_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_tv_show_user ADD CONSTRAINT FK_35B051B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tv_show_user ADD CONSTRAINT FK_35B051B7F95DF357 FOREIGN KEY (user_tv_show_id) REFERENCES user_tv_show (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tv_show DROP FOREIGN KEY FK_A9348597A76ED395');
        $this->addSql('DROP INDEX IDX_A9348597A76ED395 ON user_tv_show');
        $this->addSql('ALTER TABLE user_tv_show DROP user_id, CHANGE tv_show_id tv_show_id INT DEFAULT NULL, CHANGE overview overview LONGTEXT NOT NULL, CHANGE first_air_date first_air_date VARCHAR(255) NOT NULL, CHANGE vote_average vote_average DOUBLE PRECISION NOT NULL, CHANGE vote_count vote_count INT NOT NULL, CHANGE number_of_seasons number_of_seasons INT NOT NULL, CHANGE number_of_episodes number_of_episodes INT NOT NULL, CHANGE original_language original_language VARCHAR(255) NOT NULL, CHANGE genres genres JSON NOT NULL, CHANGE production_companies production_companies JSON NOT NULL');
    }
}
