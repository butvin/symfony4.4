<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615221811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_A45BDDC1B092A811 ON application');
        $this->addSql('ALTER TABLE application ADD icon_path VARCHAR(2047) DEFAULT NULL, CHANGE market_type market_type VARCHAR(31) NOT NULL, CHANGE store_id google_apps_id VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A45BDDC15C935BF7 ON application (google_apps_id)');
        $this->addSql('ALTER TABLE application_positions DROP FOREIGN KEY FK_529E9F7D3E030ACD');
        $this->addSql('ALTER TABLE application_positions ADD `index` INT DEFAULT 0 NOT NULL, ADD country VARCHAR(15) NOT NULL, CHANGE position position INT DEFAULT 0 NOT NULL, CHANGE location location VARCHAR(15) NOT NULL');
        $this->addSql('ALTER TABLE application_positions ADD CONSTRAINT FK_529E9F7D3E030ACD FOREIGN KEY (application_id) REFERENCES application (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_A45BDDC15C935BF7 ON application');
        $this->addSql('ALTER TABLE application DROP icon_path, CHANGE market_type market_type VARCHAR(31) CHARACTER SET utf8mb4 DEFAULT \'GOOGLE_PLAY\' COLLATE `utf8mb4_unicode_ci`, CHANGE google_apps_id store_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A45BDDC1B092A811 ON application (store_id)');
        $this->addSql('ALTER TABLE application_positions DROP FOREIGN KEY FK_529E9F7D3E030ACD');
        $this->addSql('ALTER TABLE application_positions DROP `index`, DROP country, CHANGE position position INT NOT NULL, CHANGE location location VARCHAR(63) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE application_positions ADD CONSTRAINT FK_529E9F7D3E030ACD FOREIGN KEY (application_id) REFERENCES google_play_single_app (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
