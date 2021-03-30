<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329094113 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE platform (id INT AUTO_INCREMENT NOT NULL, naam VARCHAR(255) NOT NULL, logo VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE foto_url foto_url VARCHAR(50) DEFAULT NULL, CHANGE cv_url cv_url VARCHAR(50) DEFAULT NULL, CHANGE password password VARCHAR(50) NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE vacature ADD platform_id INT NOT NULL, DROP platform_logo');
        $this->addSql('ALTER TABLE vacature ADD CONSTRAINT FK_9E5830F5FFE6496F FOREIGN KEY (platform_id) REFERENCES platform (id)');
        $this->addSql('CREATE INDEX IDX_9E5830F5FFE6496F ON vacature (platform_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vacature DROP FOREIGN KEY FK_9E5830F5FFE6496F');
        $this->addSql('DROP TABLE platform');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE foto_url foto_url VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE cv_url cv_url VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX IDX_9E5830F5FFE6496F ON vacature');
        $this->addSql('ALTER TABLE vacature ADD platform_logo VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, DROP platform_id');
    }
}
