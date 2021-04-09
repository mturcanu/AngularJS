<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408105036 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lucrari_efectuate (id INT AUTO_INCREMENT NOT NULL, tip_id INT NOT NULL, nume VARCHAR(255) NOT NULL, imagine LONGBLOB NOT NULL, INDEX IDX_924E7CA5476C47F6 (tip_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tip_animal (id INT AUTO_INCREMENT NOT NULL, nume VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lucrari_efectuate ADD CONSTRAINT FK_924E7CA5476C47F6 FOREIGN KEY (tip_id) REFERENCES tip_animal (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lucrari_efectuate DROP FOREIGN KEY FK_924E7CA5476C47F6');
        $this->addSql('DROP TABLE lucrari_efectuate');
        $this->addSql('DROP TABLE tip_animal');
    }
}
