<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250709080800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add label, expiresat and createdat';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQLPlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQLPlatform'."
        );

        $this->addSql('ALTER TABLE flownative_tokenauthentication_security_model_hashandroles ADD label VARCHAR(255) NULL, ADD expiresat TIMESTAMP(0) DEFAULT NULL, ADD createdat TIMESTAMP(0) DEFAULT NOW()');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQLPlatform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQLPlatform'."
        );

        $this->addSql('ALTER TABLE flownative_tokenauthentication_security_model_hashandroles DROP label, DROP expiresat, DROP createdat');
    }
}
