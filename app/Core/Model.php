<?php
namespace App\Core;

class Model {

    public function __construct(public \PDO $pdo) {}

    public function find($table, $fetchType = \PDO::FETCH_ASSOC) {
        $st = $this->pdo->prepare("SELECT * FROM $table;");
        $st->execute();
        return $st->fetchAll($fetchType);
    }

    public function findOne($table, $id, $fetchType = \PDO::FETCH_ASSOC) {
        $st = $this->pdo->prepare("SELECT * FROM $table WHERE id=:id");
        $st->bindParam(':id', $id, \PDO::PARAM_INT);
        $st->execute();
        return $st->fetch($fetchType);
    }

    public function save($table,$values) {
        // INSERT INTO table (campo1,campo2) VALUES (:campo1,:campo2)
        $keys = array_keys($values);
        $fields = implode(',',$keys);
        $placeholder = implode(',',
            array_map(fn($key) => ":$key", $keys)
        );
        $query = "INSERT INTO $table ($fields) VALUES ($placeholder)";      
        $stmt = $this->pdo->prepare($query);
        foreach($values as $field => $fieldValue) {
            $stmt->bindValue(":$field", $fieldValue);
        }  
        return $stmt->execute();
    }

}