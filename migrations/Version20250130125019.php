<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130125019 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_tv_show DROP FOREIGN KEY FK_A9348597A76ED395');
        $this->addSql('DROP INDEX IDX_A9348597A76ED395 ON user_tv_show');
        $this->addSql('ALTER TABLE user_tv_show DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_tv_show ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_tv_show ADD CONSTRAINT FK_A9348597A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A9348597A76ED395 ON user_tv_show (user_id)');
    }
}
