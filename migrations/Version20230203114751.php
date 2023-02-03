<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203114751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "fw_role" (id VARCHAR(32) NOT NULL, name VARCHAR(32) NOT NULL, is_primary BOOLEAN DEFAULT 0 NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AF4396B45E237E06 ON "fw_role" (name)');
        $this->addSql('CREATE TABLE "fw_role_resource" (id VARCHAR(32) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F39F514E5E237E06 ON "fw_role_resource" (name)');
        $this->addSql('CREATE TABLE fw_role_resource_access (resource_id VARCHAR(32) NOT NULL, role_id VARCHAR(32) NOT NULL, PRIMARY KEY(resource_id, role_id), CONSTRAINT FK_EB39102989329D25 FOREIGN KEY (resource_id) REFERENCES "fw_role_resource" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_EB391029D60322AC FOREIGN KEY (role_id) REFERENCES "fw_role" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_EB39102989329D25 ON fw_role_resource_access (resource_id)');
        $this->addSql('CREATE INDEX IDX_EB391029D60322AC ON fw_role_resource_access (role_id)');
        $this->addSql('CREATE TABLE "fw_user" (id VARCHAR(32) NOT NULL, role_id VARCHAR(32) DEFAULT NULL, email VARCHAR(64) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_75B9CA97D60322AC FOREIGN KEY (role_id) REFERENCES "fw_role" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_75B9CA97E7927C74 ON "fw_user" (email)');
        $this->addSql('CREATE INDEX IDX_75B9CA97D60322AC ON "fw_user" (role_id)');
        $this->addSql('CREATE TABLE "fw_user_token" (id VARCHAR(32) NOT NULL, user_id VARCHAR(32) DEFAULT NULL, token CLOB NOT NULL, expiration DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_4489308DA76ED395 FOREIGN KEY (user_id) REFERENCES "fw_user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4489308DA76ED395 ON "fw_user_token" (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "fw_role"');
        $this->addSql('DROP TABLE "fw_role_resource"');
        $this->addSql('DROP TABLE fw_role_resource_access');
        $this->addSql('DROP TABLE "fw_user"');
        $this->addSql('DROP TABLE "fw_user_token"');
    }
}
