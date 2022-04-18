<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220418013052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__woof AS SELECT id, message, username, contains_dog FROM woof');
        $this->addSql('DROP TABLE woof');
        $this->addSql('CREATE TABLE woof (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, message CLOB NOT NULL, username VARCHAR(255) NOT NULL, contains_dogs BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO woof (id, message, username, contains_dogs) SELECT id, message, username, contains_dog FROM __temp__woof');
        $this->addSql('DROP TABLE __temp__woof');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__woof AS SELECT id, message, username, contains_dogs FROM woof');
        $this->addSql('DROP TABLE woof');
        $this->addSql('CREATE TABLE woof (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, message CLOB NOT NULL, username VARCHAR(255) NOT NULL, contains_dog BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO woof (id, message, username, contains_dog) SELECT id, message, username, contains_dogs FROM __temp__woof');
        $this->addSql('DROP TABLE __temp__woof');
    }
}
