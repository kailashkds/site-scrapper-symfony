<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220930205259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration is for adding data in source table and cron table';
    }

    public function up(Schema $schema): void
    {
        if($schema->hasTable('source'))
        {
            $this->addSql("INSERT INTO `source` VALUES (null,'https://highload.today','highload today','h2','.lenta-item > p','img.wp-post-image','.meta-datetime','.lenta-item','highload.today.scraper');");
        }

        if($schema->hasTable('cron_job'))
        {
            $this->addSql("INSERT INTO `cron_job` VALUES (null,'Run sync news command','scrap:news','* 1 * * *','This cron will sync all news every one hour',1);");
        }

        if($schema->hasTable('user'))
        {
            $this->addSql("INSERT INTO `user` VALUES (null,'user@example.com','[]','$2y$13$iMJaQdji5l3EYW4vcBE.T.Vf1LHNNbD8YToPm1eiLvCMlu2vVCEwm'),(null,'admin@example.com','[\"ROLE_ADMIN\"]','$2y$13$xyik3FNb0YqGnWo5bMS5teqgV8DX4ny0uWEIAXT0iz/j8aE0JgP6q');");
        }
    }

    public function down(Schema $schema): void
    {
        if($schema->hasTable('source'))
        {
            $this->addSql("delete from source");
        }

        if($schema->hasTable('cron_job'))
        {
            $this->addSql("delete from cron_job");
        }
        
        if($schema->hasTable('user'))
        {
            $this->addSql("delete from user");
        }

    }
}
