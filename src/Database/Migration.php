<?php

namespace FluxPHP\Source\Database;

use FluxPHP\Source\Database;

class Migration
{
    protected $db;

    public function applyMigration($type = "up", \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $this->db = Database::connect();
        $newMigrations = [];
        /**
         * Output:
         * D:\FluxPHP
         */
        // echo dirname(dirname(__DIR__));


        $files = scandir(dirname(dirname(__DIR__)) . "/app/Database/Migration");
        if ($type == "down") {
            $this->db->exec("DROP TABLE IF EXISTS migrations");
            $toApplyMigration = $files;
        } else {
            $this->createMigrationTable();
            $appliedMigration = $this->getAppliedMigrations();
            $toApplyMigration = array_diff($files, $appliedMigration);
        }

        foreach ($toApplyMigration as $m) {
            if ($m == "." || $m == "..") continue;

            require_once dirname(dirname(__DIR__)) . "/app/Database/Migration/$m";
            $className = pathinfo($m, PATHINFO_FILENAME);
            $instance = new $className;
            if ($type == "down") {
                $instance->down($this->db);
                $output->writeln("<fg=bright-blue>FluxPHP <fg=white><fg=red>DOWN</> $m");
            } else {
                $instance->up($this->db);
                $output->writeln("<fg=bright-blue>FluxPHP <fg=white><fg=green>UP</> $m");
                $newMigrations[] = $m;
            }
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            if ($type == "up") {
                $output->writeln("<fg=bright-blue>FluxPHP <fg=white><fg=yellow>INFO</> All migrations is applyed!");
            }
        }
    }

    public function createMigrationTable()
    {
        $this->db->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $stmt = $this->db->prepare("SELECT name FROM migrations");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migration)
    {
        $m = implode(",", array_map(fn ($m) => "('$m')", $migration));
        $stmt = $this->db->prepare("INSERT INTO migrations (name) VALUES $m");
        $stmt->execute();
    }
}
