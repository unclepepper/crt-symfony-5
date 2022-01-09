<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220102190740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_role DROP CONSTRAINT fk_2de8c6a3d60322ac');
        $this->addSql('DROP SEQUENCE role_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE "order_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, client_name VARCHAR(255) NOT NULL, client_phone VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE role');
        $this->addSql('ALTER TABLE basket ADD order_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2246507BFCDAEAAA ON basket (order_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        
        $this->addSql('ALTER TABLE basket DROP CONSTRAINT FK_2246507BFCDAEAAA');
        $this->addSql('DROP SEQUENCE "order_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE role_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, PRIMARY KEY(user_id, role_id))');
        $this->addSql('CREATE INDEX idx_2de8c6a3a76ed395 ON user_role (user_id)');
        $this->addSql('CREATE INDEX idx_2de8c6a3d60322ac ON user_role (role_id)');
        $this->addSql('CREATE TABLE role (id INT NOT NULL, name VARCHAR(255) NOT NULL, role_name VARCHAR(255) NOT NULL, status BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT fk_2de8c6a3a76ed395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT fk_2de8c6a3d60322ac FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP INDEX IDX_2246507BFCDAEAAA');
        $this->addSql('ALTER TABLE basket DROP order_id_id');
    }
}
