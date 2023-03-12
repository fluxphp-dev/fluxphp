<?php

namespace FluxPHP\Source;

trait Model
{
    public $table;

    protected $stmt;
    protected \PDO $pdo;

    public function setup(string $tableName)
    {
        $this->table = $tableName;
        $this->pdo = Database::connect();
    }

    public function findAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        try {
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            // $title = "Unknown Table";
            $message = $e->getMessage();
            $trace = $e->getTraceAsString();
            include_once __DIR__ . "/View/Error.php";
        }
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = $id");
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} LIMIT 1");
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function query(string $query)
    {
        $query = str_replace("_", $this->table, $query);

        return $this->pdo->prepare($query);
    }
}