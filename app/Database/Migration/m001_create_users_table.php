<?php

class m001_create_users_table
{
    public function up(\PDO $pdo)
    {
        $pdo->exec('CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            email VARCHAR(255),
            password VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;');
    }

    public function down(\PDO $pdo)
    {
        $pdo->exec('DROP TABLE IF EXISTS users');
    }
}
