<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322220357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE refresh_tokens_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE component (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN component.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE component_requirement (component_id UUID NOT NULL, requirement_id UUID NOT NULL, PRIMARY KEY(component_id, requirement_id))');
        $this->addSql('CREATE INDEX IDX_812638D3E2ABAFFF ON component_requirement (component_id)');
        $this->addSql('CREATE INDEX IDX_812638D37B576F77 ON component_requirement (requirement_id)');
        $this->addSql('COMMENT ON COLUMN component_requirement.component_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN component_requirement.requirement_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE gap (id UUID NOT NULL, service_id UUID DEFAULT NULL, user_id UUID DEFAULT NULL, unit_component_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9E3A2F6DED5CA9E6 ON gap (service_id)');
        $this->addSql('CREATE INDEX IDX_9E3A2F6DA76ED395 ON gap (user_id)');
        $this->addSql('CREATE INDEX IDX_9E3A2F6D303D4D68 ON gap (unit_component_id)');
        $this->addSql('COMMENT ON COLUMN gap.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN gap.service_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN gap.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN gap.unit_component_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE refresh_tokens (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens (refresh_token)');
        $this->addSql('CREATE TABLE requirement (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN requirement.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE service (id UUID NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, date_start TIMESTAMP(6) WITHOUT TIME ZONE NOT NULL, date_end TIMESTAMP(6) WITHOUT TIME ZONE NOT NULL, date_place TIMESTAMP(6) WITHOUT TIME ZONE NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN service.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE service_unit (service_id UUID NOT NULL, unit_id UUID NOT NULL, PRIMARY KEY(service_id, unit_id))');
        $this->addSql('CREATE INDEX IDX_12F8B8BFED5CA9E6 ON service_unit (service_id)');
        $this->addSql('CREATE INDEX IDX_12F8B8BFF8BD700D ON service_unit (unit_id)');
        $this->addSql('COMMENT ON COLUMN service_unit.service_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN service_unit.unit_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE speciality (id UUID NOT NULL, name VARCHAR(255) NOT NULL, abbreviation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN speciality.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE unit (id UUID NOT NULL, speciality_id UUID DEFAULT NULL, name VARCHAR(255) NOT NULL, identifier VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DCBB0C533B5A08D7 ON unit (speciality_id)');
        $this->addSql('COMMENT ON COLUMN unit.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN unit.speciality_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE unit_component (id UUID NOT NULL, unit_id UUID DEFAULT NULL, component_id UUID DEFAULT NULL, quantity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_578A6DD5F8BD700D ON unit_component (unit_id)');
        $this->addSql('CREATE INDEX IDX_578A6DD5E2ABAFFF ON unit_component (component_id)');
        $this->addSql('COMMENT ON COLUMN unit_component.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN unit_component.unit_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN unit_component.component_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE user_speciality (id UUID NOT NULL, speciality_id UUID NOT NULL, user_id UUID NOT NULL, date_start DATE NOT NULL, date_end DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_54B066623B5A08D7 ON user_speciality (speciality_id)');
        $this->addSql('CREATE INDEX IDX_54B06662A76ED395 ON user_speciality (user_id)');
        $this->addSql('COMMENT ON COLUMN user_speciality.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_speciality.speciality_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_speciality.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users (id UUID NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, date_start DATE NOT NULL, date_end DATE DEFAULT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE user_requirement (user_id UUID NOT NULL, requirement_id UUID NOT NULL, PRIMARY KEY(user_id, requirement_id))');
        $this->addSql('CREATE INDEX IDX_72249CC5A76ED395 ON user_requirement (user_id)');
        $this->addSql('CREATE INDEX IDX_72249CC57B576F77 ON user_requirement (requirement_id)');
        $this->addSql('COMMENT ON COLUMN user_requirement.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_requirement.requirement_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE component_requirement ADD CONSTRAINT FK_812638D3E2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE component_requirement ADD CONSTRAINT FK_812638D37B576F77 FOREIGN KEY (requirement_id) REFERENCES requirement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gap ADD CONSTRAINT FK_9E3A2F6DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gap ADD CONSTRAINT FK_9E3A2F6DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE gap ADD CONSTRAINT FK_9E3A2F6D303D4D68 FOREIGN KEY (unit_component_id) REFERENCES unit_component (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_unit ADD CONSTRAINT FK_12F8B8BFED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE service_unit ADD CONSTRAINT FK_12F8B8BFF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C533B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit_component ADD CONSTRAINT FK_578A6DD5F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit_component ADD CONSTRAINT FK_578A6DD5E2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_speciality ADD CONSTRAINT FK_54B066623B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_speciality ADD CONSTRAINT FK_54B06662A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_requirement ADD CONSTRAINT FK_72249CC5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_requirement ADD CONSTRAINT FK_72249CC57B576F77 FOREIGN KEY (requirement_id) REFERENCES requirement (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SCHEMA apuntate');
        $this->addSql('DROP SEQUENCE refresh_tokens_id_seq CASCADE');
        $this->addSql('ALTER TABLE component_requirement DROP CONSTRAINT FK_812638D3E2ABAFFF');
        $this->addSql('ALTER TABLE component_requirement DROP CONSTRAINT FK_812638D37B576F77');
        $this->addSql('ALTER TABLE gap DROP CONSTRAINT FK_9E3A2F6DED5CA9E6');
        $this->addSql('ALTER TABLE gap DROP CONSTRAINT FK_9E3A2F6DA76ED395');
        $this->addSql('ALTER TABLE gap DROP CONSTRAINT FK_9E3A2F6D303D4D68');
        $this->addSql('ALTER TABLE service_unit DROP CONSTRAINT FK_12F8B8BFED5CA9E6');
        $this->addSql('ALTER TABLE service_unit DROP CONSTRAINT FK_12F8B8BFF8BD700D');
        $this->addSql('ALTER TABLE unit DROP CONSTRAINT FK_DCBB0C533B5A08D7');
        $this->addSql('ALTER TABLE unit_component DROP CONSTRAINT FK_578A6DD5F8BD700D');
        $this->addSql('ALTER TABLE unit_component DROP CONSTRAINT FK_578A6DD5E2ABAFFF');
        $this->addSql('ALTER TABLE user_speciality DROP CONSTRAINT FK_54B066623B5A08D7');
        $this->addSql('ALTER TABLE user_speciality DROP CONSTRAINT FK_54B06662A76ED395');
        $this->addSql('ALTER TABLE user_requirement DROP CONSTRAINT FK_72249CC5A76ED395');
        $this->addSql('ALTER TABLE user_requirement DROP CONSTRAINT FK_72249CC57B576F77');
        $this->addSql('DROP TABLE component');
        $this->addSql('DROP TABLE component_requirement');
        $this->addSql('DROP TABLE gap');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE requirement');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_unit');
        $this->addSql('DROP TABLE speciality');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE unit_component');
        $this->addSql('DROP TABLE user_speciality');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_requirement');
    }
}
