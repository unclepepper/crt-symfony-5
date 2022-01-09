<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211221104634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE basket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE basket (id INT NOT NULL, quantity INT NOT NULL, price_one INT NOT NULL, price_total INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE product ADD basket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD1BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D34A04AD1BE1FB52 ON product (basket_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD1BE1FB52');
        $this->addSql('DROP SEQUENCE basket_id_seq CASCADE');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP INDEX IDX_D34A04AD1BE1FB52');
        $this->addSql('ALTER TABLE product DROP basket_id');
    }
}
