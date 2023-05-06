<?php

namespace application\lib;

use PDO;

class Database
{
    protected $connection = null;

    public function __construct()
    {
        $db = require 'application/config/db.php';
        $this->connection = new PDO("mysql:host={$db['server']}; dbname={$db['database']};", $db['user'], $db['password']);
        $query = "
            CREATE TABLE IF NOT EXISTS `posts` (
                `id` int NOT NULL,
                `title` text NOT NULL,
                `description` text NOT NULL,
                `text` text NOT NULL,
                `date` text NOT NULL
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            
            ALTER TABLE `posts`
                ADD PRIMARY KEY (`id`);  
            
            ALTER TABLE `posts`
                MODIFY `id` int NOT NULL AUTO_INCREMENT;
            COMMIT;
                ";
        $this->query($query);
    }

    public function query(string $sql, $params = [])
    {
        $query = $this->connection->prepare($sql);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $query->bindValue(":$key", $value);
            }
        }
        $query->execute();

        return $query;
    }
    public function row(string $sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function column(string $sql, $params = [])
    {
        return $this->query($sql, $params)->fetchColumn();
    }
    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}
