<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190829134022 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscription ADD alert_id INT NOT NULL, ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D393035F72 FOREIGN KEY (alert_id) REFERENCES alert (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D367B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_A3C664D393035F72 ON subscription (alert_id)');
        $this->addSql('CREATE INDEX IDX_A3C664D367B3B43D ON subscription (users_id)');
        $this->addSql('ALTER TABLE user_event_participation ADD users_id INT NOT NULL, ADD event_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_event_participation ADD CONSTRAINT FK_A5CF3D9167B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_event_participation ADD CONSTRAINT FK_A5CF3D9171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('CREATE INDEX IDX_A5CF3D9167B3B43D ON user_event_participation (users_id)');
        $this->addSql('CREATE INDEX IDX_A5CF3D9171F7E88B ON user_event_participation (event_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D393035F72');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D367B3B43D');
        $this->addSql('DROP INDEX IDX_A3C664D393035F72 ON subscription');
        $this->addSql('DROP INDEX IDX_A3C664D367B3B43D ON subscription');
        $this->addSql('ALTER TABLE subscription DROP alert_id, DROP users_id');
        $this->addSql('ALTER TABLE user_event_participation DROP FOREIGN KEY FK_A5CF3D9167B3B43D');
        $this->addSql('ALTER TABLE user_event_participation DROP FOREIGN KEY FK_A5CF3D9171F7E88B');
        $this->addSql('DROP INDEX IDX_A5CF3D9167B3B43D ON user_event_participation');
        $this->addSql('DROP INDEX IDX_A5CF3D9171F7E88B ON user_event_participation');
        $this->addSql('ALTER TABLE user_event_participation DROP users_id, DROP event_id');
    }
}
