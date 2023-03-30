<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230329073417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reduce (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, value INT NOT NULL, date_start DATE NOT NULL, date_end DATE NOT NULL, active TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD reduce_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398CF2BB328 FOREIGN KEY (reduce_id) REFERENCES reduce (id)');
        $this->addSql('CREATE INDEX IDX_F5299398CF2BB328 ON `order` (reduce_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398CF2BB328');
        $this->addSql('DROP TABLE reduce');
        $this->addSql('DROP INDEX IDX_F5299398CF2BB328 ON `order`');
        $this->addSql('ALTER TABLE `order` DROP reduce_id');
    }
}
