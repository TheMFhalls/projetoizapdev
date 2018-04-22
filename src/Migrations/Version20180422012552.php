<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180422012552 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cidade DROP FOREIGN KEY FK_6A98335C1F6FF82C');
        $this->addSql('DROP INDEX IDX_6A98335C1F6FF82C ON cidade');
        $this->addSql('ALTER TABLE cidade CHANGE id_estado_id estado_id INT NOT NULL');
        $this->addSql('ALTER TABLE cidade ADD CONSTRAINT FK_6A98335C9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id)');
        $this->addSql('CREATE INDEX IDX_6A98335C9F5A440B ON cidade (estado_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cidade DROP FOREIGN KEY FK_6A98335C9F5A440B');
        $this->addSql('DROP INDEX IDX_6A98335C9F5A440B ON cidade');
        $this->addSql('ALTER TABLE cidade CHANGE estado_id id_estado_id INT NOT NULL');
        $this->addSql('ALTER TABLE cidade ADD CONSTRAINT FK_6A98335C1F6FF82C FOREIGN KEY (id_estado_id) REFERENCES estado (id)');
        $this->addSql('CREATE INDEX IDX_6A98335C1F6FF82C ON cidade (id_estado_id)');
    }
}
