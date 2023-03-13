<?php

use FluxPHP\Source\Database\Table;

class m001_create_users_table
{
    public function up(\PDO $pdo)
    {
        // $pdo->exec('CREATE TABLE IF NOT EXISTS users (
        //     id INT AUTO_INCREMENT PRIMARY KEY,
        //     name VARCHAR(255),
        //     email VARCHAR(255),
        //     password VARCHAR(255),
        //     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        //     ) ENGINE=INNODB;');

        $table = new Table("users");
        $table->varchar("name");
        $table->varchar("email");
        $table->varchar("password");
        $table->created_at();
    }

    public function down(\PDO $pdo)
    {
        $pdo->exec('DROP TABLE IF EXISTS users');
    }
}
