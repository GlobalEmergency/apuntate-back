<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240410223632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gap ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE gap ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE service ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE service ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE service ALTER date_start TYPE TIMESTAMP(6) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE service ALTER date_end TYPE TIMESTAMP(6) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE service ALTER date_place TYPE TIMESTAMP(6) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE speciality ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE speciality ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE user_speciality ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE user_speciality ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE users ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE users ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SCHEMA apuntate');
        $this->addSql('ALTER TABLE user_speciality DROP created_at');
        $this->addSql('ALTER TABLE user_speciality DROP updated_at');
        $this->addSql('ALTER TABLE speciality DROP created_at');
        $this->addSql('ALTER TABLE speciality DROP updated_at');
        $this->addSql('ALTER TABLE users DROP created_at');
        $this->addSql('ALTER TABLE users DROP updated_at');
        $this->addSql('ALTER TABLE gap DROP created_at');
        $this->addSql('ALTER TABLE gap DROP updated_at');
        $this->addSql('ALTER TABLE service DROP created_at');
        $this->addSql('ALTER TABLE service DROP updated_at');
        $this->addSql('ALTER TABLE service ALTER date_start TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE service ALTER date_end TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE service ALTER date_place TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
    }
}
