<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527090024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE component (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE component_requirement (component_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', requirement_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_812638D3E2ABAFFF (component_id), INDEX IDX_812638D37B576F77 (requirement_id), PRIMARY KEY(component_id, requirement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gap (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', service_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', user_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', unit_component_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_9E3A2F6DED5CA9E6 (service_id), INDEX IDX_9E3A2F6DA76ED395 (user_id), INDEX IDX_9E3A2F6D303D4D68 (unit_component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE requirement (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, date_start DATETIME(6) NOT NULL, date_end DATETIME(6) NOT NULL, date_place DATETIME(6) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service_unit (service_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', unit_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_12F8B8BFED5CA9E6 (service_id), INDEX IDX_12F8B8BFF8BD700D (unit_id), PRIMARY KEY(service_id, unit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE speciality (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, abbreviation VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', speciality_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, identifier VARCHAR(255) NOT NULL, INDEX IDX_DCBB0C533B5A08D7 (speciality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit_component (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', unit_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', component_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', quantity INT NOT NULL, INDEX IDX_578A6DD5F8BD700D (unit_id), INDEX IDX_578A6DD5E2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_speciality (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', speciality_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', date_start DATE NOT NULL, date_end DATE DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_54B066623B5A08D7 (speciality_id), INDEX IDX_54B06662A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, date_start DATE NOT NULL, date_end DATE DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_requirement (user_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', requirement_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_72249CC5A76ED395 (user_id), INDEX IDX_72249CC57B576F77 (requirement_id), PRIMARY KEY(user_id, requirement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE component_requirement ADD CONSTRAINT FK_812638D3E2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE component_requirement ADD CONSTRAINT FK_812638D37B576F77 FOREIGN KEY (requirement_id) REFERENCES requirement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gap ADD CONSTRAINT FK_9E3A2F6DED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE gap ADD CONSTRAINT FK_9E3A2F6DA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE gap ADD CONSTRAINT FK_9E3A2F6D303D4D68 FOREIGN KEY (unit_component_id) REFERENCES unit_component (id)');
        $this->addSql('ALTER TABLE service_unit ADD CONSTRAINT FK_12F8B8BFED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_unit ADD CONSTRAINT FK_12F8B8BFF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C533B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('ALTER TABLE unit_component ADD CONSTRAINT FK_578A6DD5F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE unit_component ADD CONSTRAINT FK_578A6DD5E2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id)');
        $this->addSql('ALTER TABLE user_speciality ADD CONSTRAINT FK_54B066623B5A08D7 FOREIGN KEY (speciality_id) REFERENCES speciality (id)');
        $this->addSql('ALTER TABLE user_speciality ADD CONSTRAINT FK_54B06662A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_requirement ADD CONSTRAINT FK_72249CC5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_requirement ADD CONSTRAINT FK_72249CC57B576F77 FOREIGN KEY (requirement_id) REFERENCES requirement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE component_requirement DROP FOREIGN KEY FK_812638D3E2ABAFFF');
        $this->addSql('ALTER TABLE component_requirement DROP FOREIGN KEY FK_812638D37B576F77');
        $this->addSql('ALTER TABLE gap DROP FOREIGN KEY FK_9E3A2F6DED5CA9E6');
        $this->addSql('ALTER TABLE gap DROP FOREIGN KEY FK_9E3A2F6DA76ED395');
        $this->addSql('ALTER TABLE gap DROP FOREIGN KEY FK_9E3A2F6D303D4D68');
        $this->addSql('ALTER TABLE service_unit DROP FOREIGN KEY FK_12F8B8BFED5CA9E6');
        $this->addSql('ALTER TABLE service_unit DROP FOREIGN KEY FK_12F8B8BFF8BD700D');
        $this->addSql('ALTER TABLE unit DROP FOREIGN KEY FK_DCBB0C533B5A08D7');
        $this->addSql('ALTER TABLE unit_component DROP FOREIGN KEY FK_578A6DD5F8BD700D');
        $this->addSql('ALTER TABLE unit_component DROP FOREIGN KEY FK_578A6DD5E2ABAFFF');
        $this->addSql('ALTER TABLE user_speciality DROP FOREIGN KEY FK_54B066623B5A08D7');
        $this->addSql('ALTER TABLE user_speciality DROP FOREIGN KEY FK_54B06662A76ED395');
        $this->addSql('ALTER TABLE user_requirement DROP FOREIGN KEY FK_72249CC5A76ED395');
        $this->addSql('ALTER TABLE user_requirement DROP FOREIGN KEY FK_72249CC57B576F77');
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
