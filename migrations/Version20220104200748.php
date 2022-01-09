<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220104200748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_basket (order_id INT NOT NULL, basket_id INT NOT NULL, PRIMARY KEY(order_id, basket_id))');
        $this->addSql('CREATE INDEX IDX_E1C940AE8D9F6D38 ON order_basket (order_id)');
        $this->addSql('CREATE INDEX IDX_E1C940AE1BE1FB52 ON order_basket (basket_id)');
        $this->addSql('ALTER TABLE order_basket ADD CONSTRAINT FK_E1C940AE8D9F6D38 FOREIGN KEY (order_id) REFERENCES "order" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_basket ADD CONSTRAINT FK_E1C940AE1BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
       
        $this->addSql('DROP TABLE order_basket');
    }
}
