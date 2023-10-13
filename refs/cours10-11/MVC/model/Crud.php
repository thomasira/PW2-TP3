<?php

abstract class Crud extends PDO {

    public function __construct() {
        parent::__construct("mysql:host=localhost;dbname=ecommerce;port=3306;charset=utf8", "root", "");
    }

    public function create($data) {
        $data_keys = array_fill_keys($this->fillable, "");
        $data = array_intersect_key($data, $data_keys);
        $fieldName = implode(", ", array_keys($data));
        $fieldSafe = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldSafe)";
        $query = $this->prepare($sql);
        foreach ($data as $key => $value) $query->bindValue(":$key", $value);
        $query->execute();
        return $this->lastInsertId();
    }

    public function read($order = null) {
        $join = "";
        $target = "*";
        if(isset($this->target)) $target = implode(", ", $this->target);
        if(isset($this->tablesMg))
            foreach($this->tablesMg as $tableMg) 
                $join .= "LEFT OUTER JOIN $tableMg ON " . $tableMg . "_id = $tableMg" . ".id";
        $sql = "SELECT $target FROM $this->table $join ORDER BY id $order";
        $query = $this->query($sql);
        return $query->fetchAll();
    }

    public function readId($value) {
        $join = "";
        $target = "*";
        if(isset($this->target)) $target = implode(", ", $this->target);
        if(isset($this->tablesMg)) 
            foreach($this->tablesMg as $tableMg) 
                $join .= "LEFT OUTER JOIN $tableMg ON " . $tableMg . "_id = $tableMg" . ".id";
        $sql = "SELECT $target FROM $this->table $join WHERE $this->table.$this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        $query->bindValue(":$this->primaryKey", $value);
        $query->execute();
        $count = $query->rowCount();
        if ($count == 1) return $query->fetch();
        else header("location: ../../home/error");
    }

    public function update($data) {
        $data_keys = array_fill_keys($this->fillable, "");
        $data = array_intersect_key($data, $data_keys);
        $set = "";
        $id = $data["id"];
        foreach ($data as $field => $value) $set .= " $field = :$field,"; 
        $set = Rtrim($set, ",");
        $sql = "UPDATE $this->table SET $set WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        foreach ($data as $field => $value) $query->bindValue(":$field", $value);
        if($query->execute()) return $id;
        else return $query->errorInfo(); 
    }

    public function delete($data) {
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        $query->bindValue(":$this->primaryKey", $data);
        if($query->execute()) return true;
        else print_r($query->errorInfo());
    }
}

?>
