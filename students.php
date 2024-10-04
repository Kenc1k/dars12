<?php

include "database.php";

class students extends database {
    public static $table = "students";

    public static function all() {
        $sql = "SELECT * FROM " . self::$table;
        $query = self::getConnection()->query($sql);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id) {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = :id";
        $statement = self::getConnection()->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public static function create($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO " . self::$table . " ({$columns}) VALUES ({$placeholders})";
        $statement = self::getConnection()->prepare($sql);
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        return $statement->execute();
    }

    public static function update($id, $data) {
        $columns = "";
        foreach ($data as $key => $value) {
            $columns .= "$key = :$key, ";
        }
        $columns = rtrim($columns, ", ");
        $sql = "UPDATE " . self::$table . " SET {$columns} WHERE id = :id";
        $statement = self::getConnection()->prepare($sql);
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->bindValue(":id", $id);
        return $statement->execute();
    }

    public static function delete($id) {
        $sql = "DELETE FROM " . self::$table . " WHERE id = :id";
        $statement = self::getConnection()->prepare($sql);
        $statement->bindParam(":id", $id);
        return $statement->execute();
    }

    public static function paginate($limit, $offset) {
        $sql = "SELECT * FROM " . self::$table . " LIMIT :limit OFFSET :offset";
        $query = self::getConnection()->prepare($sql);
        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
        $query->bindValue(":offset", $offset, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function count() {
        $sql = "SELECT COUNT(*) AS total FROM " . self::$table;
        $query = self::getConnection()->query($sql);
        return $query->fetch(PDO::FETCH_OBJ)->total;
    }
}
?>
