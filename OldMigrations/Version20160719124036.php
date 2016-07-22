<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160719124036 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, projectName VARCHAR(255) DEFAULT NULL, projectDesc LONGTEXT NOT NULL, assignedTo INT DEFAULT NULL, endDate DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_note (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, username VARCHAR(255) NOT NULL, user_avatar_file_name VARCHAR(255) NOT NULL, note LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F62C320C166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project_note ADD CONSTRAINT FK_F62C320C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project_note DROP FOREIGN KEY FK_F62C320C166D1F9C');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_note');
    }
}
