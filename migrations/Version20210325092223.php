<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325092223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE solicitatie DROP FOREIGN KEY FK_992A48F59D86650F');
        $this->addSql('ALTER TABLE solicitatie DROP FOREIGN KEY FK_992A48F5E836F050');
        $this->addSql('DROP INDEX IDX_992A48F5E836F050 ON solicitatie');
        $this->addSql('DROP INDEX IDX_992A48F59D86650F ON solicitatie');
        $this->addSql('ALTER TABLE solicitatie ADD user_id INT NOT NULL, ADD vacature_id INT NOT NULL, DROP user_id_id, DROP vacature_id_id');
        $this->addSql('ALTER TABLE solicitatie ADD CONSTRAINT FK_992A48F5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE solicitatie ADD CONSTRAINT FK_992A48F56FB89BA0 FOREIGN KEY (vacature_id) REFERENCES vacature (id)');
        $this->addSql('CREATE INDEX IDX_992A48F5A76ED395 ON solicitatie (user_id)');
        $this->addSql('CREATE INDEX IDX_992A48F56FB89BA0 ON solicitatie (vacature_id)');
        $this->addSql('ALTER TABLE user CHANGE foto_url foto_url VARCHAR(50) DEFAULT NULL, CHANGE cv_url cv_url VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE vacature DROP FOREIGN KEY FK_9E5830F5DEA8A3AB');
        $this->addSql('DROP INDEX IDX_9E5830F5DEA8A3AB ON vacature');
        $this->addSql('ALTER TABLE vacature CHANGE bedrijf_id_id bedrijf_id INT NOT NULL');
        $this->addSql('ALTER TABLE vacature ADD CONSTRAINT FK_9E5830F5740E9210 FOREIGN KEY (bedrijf_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9E5830F5740E9210 ON vacature (bedrijf_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE solicitatie DROP FOREIGN KEY FK_992A48F5A76ED395');
        $this->addSql('ALTER TABLE solicitatie DROP FOREIGN KEY FK_992A48F56FB89BA0');
        $this->addSql('DROP INDEX IDX_992A48F5A76ED395 ON solicitatie');
        $this->addSql('DROP INDEX IDX_992A48F56FB89BA0 ON solicitatie');
        $this->addSql('ALTER TABLE solicitatie ADD user_id_id INT NOT NULL, ADD vacature_id_id INT NOT NULL, DROP user_id, DROP vacature_id');
        $this->addSql('ALTER TABLE solicitatie ADD CONSTRAINT FK_992A48F59D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE solicitatie ADD CONSTRAINT FK_992A48F5E836F050 FOREIGN KEY (vacature_id_id) REFERENCES vacature (id)');
        $this->addSql('CREATE INDEX IDX_992A48F5E836F050 ON solicitatie (vacature_id_id)');
        $this->addSql('CREATE INDEX IDX_992A48F59D86650F ON solicitatie (user_id_id)');
        $this->addSql('ALTER TABLE user CHANGE foto_url foto_url VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE cv_url cv_url VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE vacature DROP FOREIGN KEY FK_9E5830F5740E9210');
        $this->addSql('DROP INDEX IDX_9E5830F5740E9210 ON vacature');
        $this->addSql('ALTER TABLE vacature CHANGE bedrijf_id bedrijf_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE vacature ADD CONSTRAINT FK_9E5830F5DEA8A3AB FOREIGN KEY (bedrijf_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9E5830F5DEA8A3AB ON vacature (bedrijf_id_id)');
    }
}
