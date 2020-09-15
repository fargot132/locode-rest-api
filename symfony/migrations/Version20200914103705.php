<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200914103705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location ADD port TINYINT(1) DEFAULT \'0\' NOT NULL, ADD rail TINYINT(1) DEFAULT \'0\' NOT NULL, ADD road TINYINT(1) DEFAULT \'0\' NOT NULL, ADD airport TINYINT(1) DEFAULT \'0\' NOT NULL, ADD postoffice TINYINT(1) DEFAULT \'0\' NOT NULL, ADD reserved1 TINYINT(1) DEFAULT \'0\' NOT NULL, ADD reserved2 TINYINT(1) DEFAULT \'0\' NOT NULL, ADD border TINYINT(1) DEFAULT \'0\' NOT NULL, ADD notknown TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP port, DROP rail, DROP road, DROP airport, DROP postoffice, DROP reserved1, DROP reserved2, DROP border, DROP notknown');
    }
}
