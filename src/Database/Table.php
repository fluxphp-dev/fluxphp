<?php

namespace FluxPHP\Source\Database;

use FluxPHP\Source\Database;

class Table
{
    protected \PDO $pdo;
    protected $table;

    public function __construct(string $table)
    {
        $this->pdo = Database::connect();
        $this->table = $table;

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS {$this->table} (
            id INT AUTO_INCREMENT PRIMARY KEY
        ) Engine=InnoDB;");
    }


    public function created_at()
    {
        $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    }

    public function varchar(string $name, int $length = 255)
    {
        $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} VARCHAR({$length})");
    }

    public function text(string $name, int $length = 255)
    {
        $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} TEXT({$length})");
    }

    public function timestamp(string $name)
    {
        $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    }

    public function bool(string $name, int $length = 255, bool $notNull = false)
    {
        if ($notNull == false) {
            $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} BOOLEAN({$length})");
        } else {
            $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} BOOLEAN({$length}) NOT NULL");
        }
    }

    public function int(string $name, int $length = 255, bool $autoIncrement = false, bool $notNull = false)
    {
        if ($autoIncrement == false) {
            if ($notNull == false) {
                $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} INT({$length})");
            } else {
                $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} INT({$length}) NOT NULL");
            }
        } else {
            if ($notNull == false) {
                $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} INT({$length}) AUTO_INCREMENT PRIMARY KEY");
            } else {
                $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} INT({$length}) AUTO_INCREMENT PRIMARY KEY NOT NULL");
            }
        }
    }

    public function float(string $name, int $length = 255, bool $autoIncrement = false, bool $notNull = false)
    {
        if ($autoIncrement == false) {
            if ($notNull == false) {
                $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} FLOAT({$length})");
            } else {
                $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} FLOAT({$length}) NOT NULL");
            }
        } else {
            if ($notNull == false) {
                $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} FLOAT({$length}) AUTO_INCREMENT PRIMARY KEY");
            } else {
                $this->pdo->exec("ALTER TABLE {$this->table} ADD COLUMN {$name} FLOAT({$length}) AUTO_INCREMENT PRIMARY KEY NOT NULL");
            }
        }
    }
}
