<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190829135845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category_event (category_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_D39D45EE12469DE2 (category_id), INDEX IDX_D39D45EE71F7E88B (event_id), PRIMARY KEY(category_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_groups (users_id INT NOT NULL, groups_id INT NOT NULL, INDEX IDX_FF8AB7E067B3B43D (users_id), INDEX IDX_FF8AB7E0F373DCF (groups_id), PRIMARY KEY(users_id, groups_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_event ADD CONSTRAINT FK_D39D45EE12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_event ADD CONSTRAINT FK_D39D45EE71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_groups ADD CONSTRAINT FK_FF8AB7E067B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_groups ADD CONSTRAINT FK_FF8AB7E0F373DCF FOREIGN KEY (groups_id) REFERENCES groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD event_id INT NOT NULL, ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_9474526C71F7E88B ON comment (event_id)');
        $this->addSql('CREATE INDEX IDX_9474526C67B3B43D ON comment (users_id)');
        $this->addSql('ALTER TABLE event ADD adress_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA78486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3BAE0AA78486F9AC ON event (adress_id)');
        $this->addSql('ALTER TABLE users ADD adress_id INT DEFAULT NULL, ADD distance_km SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E98486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E98486F9AC ON users (adress_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE category_event');
        $this->addSql('DROP TABLE users_groups');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C71F7E88B');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C67B3B43D');
        $this->addSql('DROP INDEX IDX_9474526C71F7E88B ON comment');
        $this->addSql('DROP INDEX IDX_9474526C67B3B43D ON comment');
        $this->addSql('ALTER TABLE comment DROP event_id, DROP users_id');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA78486F9AC');
        $this->addSql('DROP INDEX UNIQ_3BAE0AA78486F9AC ON event');
        $this->addSql('ALTER TABLE event DROP adress_id');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E98486F9AC');
        $this->addSql('DROP INDEX UNIQ_1483A5E98486F9AC ON users');
        $this->addSql('ALTER TABLE users DROP adress_id, DROP distance_km');
    }
}
