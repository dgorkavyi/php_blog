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
    }

    public function query(string $sql, $params = [])
    {
        $query = $this->connection->prepare($sql);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $query->bindValue(":$key", $value);
            }
        }
        $file = fopen('./test.txt', 'a');
        fwrite($file, var_export("$query->queryString", true) . "\n");
        fclose($file);
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
}