<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615212624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE application (id INT AUTO_INCREMENT NOT NULL, store_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(2047) NOT NULL, language VARCHAR(15) DEFAULT NULL, location VARCHAR(15) DEFAULT NULL, is_free TINYINT(1) DEFAULT NULL, icon_url VARCHAR(2047) DEFAULT NULL, icon_binary LONGBLOB DEFAULT NULL, category_id VARCHAR(255) NOT NULL, market_type VARCHAR(31) DEFAULT \'GOOGLE_PLAY\', developer_id INT NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A45BDDC1B092A811 (store_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE application');
    }
}
