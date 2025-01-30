<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130112046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_faker (id INT AUTO_INCREMENT NOT NULL, movie_id INT NOT NULL, title VARCHAR(255) NOT NULL, overview LONGTEXT DEFAULT NULL, release_date VARCHAR(255) DEFAULT NULL, vote_average DOUBLE PRECISION DEFAULT NULL, vote_count INT DEFAULT NULL, runtime INT DEFAULT NULL, original_language VARCHAR(255) DEFAULT NULL, budget INT DEFAULT NULL, revenue INT DEFAULT NULL, genres LONGTEXT DEFAULT NULL, production_companies LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user_movie (user_id INT NOT NULL, user_movie_id INT NOT NULL, INDEX IDX_58FBCFDBA76ED395 (user_id), INDEX IDX_58FBCFDB6F1E52FC (user_movie_id), PRIMARY KEY(user_id, user_movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_user_tv_show (user_id INT NOT NULL, user_tv_show_id INT NOT NULL, INDEX IDX_29F8F995A76ED395 (user_id), INDEX IDX_29F8F995F95DF357 (user_tv_show_id), PRIMARY KEY(user_id, user_tv_show_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_film_faker (user_id INT NOT NULL, film_faker_id INT NOT NULL, INDEX IDX_8FC27619A76ED395 (user_id), INDEX IDX_8FC2761997378DFC (film_faker_id), PRIMARY KEY(user_id, film_faker_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_movie (id INT AUTO_INCREMENT NOT NULL, movie_id INT NOT NULL, title VARCHAR(255) NOT NULL, overview LONGTEXT DEFAULT NULL, release_date VARCHAR(255) DEFAULT NULL, vote_average DOUBLE PRECISION DEFAULT NULL, vote_count INT DEFAULT NULL, runtime INT DEFAULT NULL, original_language VARCHAR(255) DEFAULT NULL, budget INT DEFAULT NULL, revenue INT DEFAULT NULL, genres LONGTEXT DEFAULT NULL, production_companies LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tv_show (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tv_show_id INT NOT NULL, name VARCHAR(255) NOT NULL, overview LONGTEXT DEFAULT NULL, first_air_date VARCHAR(255) DEFAULT NULL, vote_average DOUBLE PRECISION DEFAULT NULL, vote_count INT DEFAULT NULL, number_of_seasons INT DEFAULT NULL, number_of_episodes INT DEFAULT NULL, original_language VARCHAR(255) DEFAULT NULL, genres LONGTEXT DEFAULT NULL, production_companies LONGTEXT DEFAULT NULL, INDEX IDX_A9348597A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_user_movie ADD CONSTRAINT FK_58FBCFDBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_movie ADD CONSTRAINT FK_58FBCFDB6F1E52FC FOREIGN KEY (user_movie_id) REFERENCES user_movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_tv_show ADD CONSTRAINT FK_29F8F995A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_user_tv_show ADD CONSTRAINT FK_29F8F995F95DF357 FOREIGN KEY (user_tv_show_id) REFERENCES user_tv_show (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_film_faker ADD CONSTRAINT FK_8FC27619A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_film_faker ADD CONSTRAINT FK_8FC2761997378DFC FOREIGN KEY (film_faker_id) REFERENCES film_faker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tv_show ADD CONSTRAINT FK_A9348597A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_user_movie DROP FOREIGN KEY FK_58FBCFDBA76ED395');
        $this->addSql('ALTER TABLE user_user_movie DROP FOREIGN KEY FK_58FBCFDB6F1E52FC');
        $this->addSql('ALTER TABLE user_user_tv_show DROP FOREIGN KEY FK_29F8F995A76ED395');
        $this->addSql('ALTER TABLE user_user_tv_show DROP FOREIGN KEY FK_29F8F995F95DF357');
        $this->addSql('ALTER TABLE user_film_faker DROP FOREIGN KEY FK_8FC27619A76ED395');
        $this->addSql('ALTER TABLE user_film_faker DROP FOREIGN KEY FK_8FC2761997378DFC');
        $this->addSql('ALTER TABLE user_tv_show DROP FOREIGN KEY FK_A9348597A76ED395');
        $this->addSql('DROP TABLE film_faker');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_user_movie');
        $this->addSql('DROP TABLE user_user_tv_show');
        $this->addSql('DROP TABLE user_film_faker');
        $this->addSql('DROP TABLE user_movie');
        $this->addSql('DROP TABLE user_tv_show');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
