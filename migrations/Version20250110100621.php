<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250110100621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE film_faker (id INT AUTO_INCREMENT NOT NULL, movie_id INT NOT NULL, title VARCHAR(255) NOT NULL, overview LONGTEXT NOT NULL, release_date VARCHAR(255) NOT NULL, vote_average DOUBLE PRECISION NOT NULL, vote_count INT NOT NULL, runtime INT NOT NULL, original_language VARCHAR(255) NOT NULL, budget INT NOT NULL, revenue INT NOT NULL, genres LONGTEXT NOT NULL, production_companies LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE film_faker_user (film_faker_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CFFE06C497378DFC (film_faker_id), INDEX IDX_CFFE06C4A76ED395 (user_id), PRIMARY KEY(film_faker_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE film_faker_user ADD CONSTRAINT FK_CFFE06C497378DFC FOREIGN KEY (film_faker_id) REFERENCES film_faker (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE film_faker_user ADD CONSTRAINT FK_CFFE06C4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE film_faker_user DROP FOREIGN KEY FK_CFFE06C497378DFC');
        $this->addSql('ALTER TABLE film_faker_user DROP FOREIGN KEY FK_CFFE06C4A76ED395');
        $this->addSql('DROP TABLE film_faker');
        $this->addSql('DROP TABLE film_faker_user');
    }
}
