<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240122102907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create order table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE order (
            id INT AUTO_INCREMENT NOT NULL,
            product_id INT NOT NULL,
            quantity INT NOT NULL,
            order_date DATE NOT NULL,
            PRIMARY KEY(id)
        )');
    }

    public function down(Schema $schema): void
    {
    }
}
