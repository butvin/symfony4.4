<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615000026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application_positions (id INT AUTO_INCREMENT NOT NULL, application_id INT DEFAULT NULL, category_id VARCHAR(127) NOT NULL, position INT NOT NULL, language VARCHAR(15) NOT NULL, location VARCHAR(63) NOT NULL, INDEX IDX_529E9F7D3E030ACD (application_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE application_positions ADD CONSTRAINT FK_529E9F7D3E030ACD FOREIGN KEY (application_id) REFERENCES google_play_single_app (id)');
        $this->addSql('ALTER TABLE google_play_single_app DROP position');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2421F029B092A811 ON google_play_single_app (store_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE application_positions');
        $this->addSql('DROP INDEX UNIQ_2421F029B092A811 ON google_play_single_app');
        $this->addSql('ALTER TABLE google_play_single_app ADD position INT DEFAULT 0');
    }
}
