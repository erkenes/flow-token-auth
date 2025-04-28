<?php
namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Adjust table for token authentication
 */
class Version20250403223549 extends AbstractMigration
{

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Adjust table for token authentication';
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');

        $this->addSql('ALTER TABLE flownative_tokenauthentication_security_model_hashandroles
            MODIFY roles JSON NOT NULL COMMENT \'(DC2Type:flow_json_array)\',
            MODIFY settings JSON NOT NULL COMMENT \'(DC2Type:flow_json_array)\'');

    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');

        $this->addSql('ALTER TABLE flownative_tokenauthentication_security_model_hashandroles
            MODIFY roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\',
            MODIFY settings LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\'');

    }
}
