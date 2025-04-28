<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Adjust table for token authentication
 */
class Version20250403223550 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Adjust table for token authentication.';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );
        $this->addSql('COMMENT ON COLUMN flownative_tokenauthentication_security_model_hashandroles.roles IS \'(DC2Type:flow_json_array)\'');
        $this->addSql('COMMENT ON COLUMN flownative_tokenauthentication_security_model_hashandroles.settings IS \'(DC2Type:flow_json_array)\'');


    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );
        $this->addSql('COMMENT ON COLUMN flownative_tokenauthentication_security_model_hashandroles.roles IS \'(DC2Type:json_array)\'');
        $this->addSql('COMMENT ON COLUMN flownative_tokenauthentication_security_model_hashandroles.settings IS \'(DC2Type:json_array)\'');


    }
}
