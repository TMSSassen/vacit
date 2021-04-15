<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325091830 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sollicitatie (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, vacature_id_id INT NOT NULL, datum DATETIME NOT NULL, uitgenodigd TINYINT(1) NOT NULL, INDEX IDX_992A48F59D86650F (user_id_id), INDEX IDX_992A48F5E836F050 (vacature_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, voornaam VARCHAR(50) NOT NULL, achternaam VARCHAR(50) NOT NULL, geboortedatum DATETIME NOT NULL, telefoonnummer VARCHAR(15) NOT NULL, adres VARCHAR(50) NOT NULL, postcode VARCHAR(8) NOT NULL, email VARCHAR(50) NOT NULL, woonplaats VARCHAR(50) NOT NULL, beschrijving LONGTEXT NOT NULL, foto_url VARCHAR(50) DEFAULT NULL, cv_url VARCHAR(50) DEFAULT NULL, rol VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacature (id INT AUTO_INCREMENT NOT NULL, bedrijf_id_id INT NOT NULL, datum DATETIME NOT NULL, titel VARCHAR(50) NOT NULL, standplaats VARCHAR(50) NOT NULL, niveau VARCHAR(15) NOT NULL, bedrijf_logo VARCHAR(50) NOT NULL, platform_logo VARCHAR(50) NOT NULL, beschrijving LONGTEXT NOT NULL, INDEX IDX_9E5830F5DEA8A3AB (bedrijf_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sollicitatie ADD CONSTRAINT FK_992A48F59D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sollicitatie ADD CONSTRAINT FK_992A48F5E836F050 FOREIGN KEY (vacature_id_id) REFERENCES vacature (id)');
        $this->addSql('ALTER TABLE vacature ADD CONSTRAINT FK_9E5830F5DEA8A3AB FOREIGN KEY (bedrijf_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sollicitatie DROP FOREIGN KEY FK_992A48F59D86650F');
        $this->addSql('ALTER TABLE vacature DROP FOREIGN KEY FK_9E5830F5DEA8A3AB');
        $this->addSql('ALTER TABLE sollicitatie DROP FOREIGN KEY FK_992A48F5E836F050');
        $this->addSql('DROP TABLE sollicitatie');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vacature');
    }
}
