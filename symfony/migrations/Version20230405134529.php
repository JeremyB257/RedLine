<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405134529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398CF2BB328');
        $this->addSql('DROP INDEX IDX_F5299398CF2BB328 ON `order`');
        $this->addSql('ALTER TABLE `order` CHANGE reduce_id reduce INT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_338C920877153098 ON reduce (code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` CHANGE reduce reduce_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398CF2BB328 FOREIGN KEY (reduce_id) REFERENCES reduce (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F5299398CF2BB328 ON `order` (reduce_id)');
        $this->addSql('DROP INDEX UNIQ_338C920877153098 ON reduce');
    }
}
