<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210614224533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE google_play_single_app (id INT AUTO_INCREMENT NOT NULL, store_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, position INT DEFAULT 0, url VARCHAR(2047) NOT NULL, language VARCHAR(15) DEFAULT NULL, location VARCHAR(15) DEFAULT NULL, is_free TINYINT(1) DEFAULT NULL, icon_url VARCHAR(2047) DEFAULT NULL, icon_binary LONGBLOB DEFAULT NULL, category_id VARCHAR(255) NOT NULL, market_type VARCHAR(31) DEFAULT \'GOOGLE_PLAY\', developer_id INT NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE google_play_single_app');
    }
}
