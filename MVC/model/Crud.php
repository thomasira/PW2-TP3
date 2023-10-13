<?php

abstract class Crud extends PDO {

    public function __construct() {
        parent::__construct("mysql:host=localhost;dbname=e2395387;port=3306;charset=utf8", "root", "12345678");
    }

    /**
     * lire les entrées de la DB associées aux données de la classe
     */
    public function read($order = null) {
        $sql = "SELECT * FROM $this->table ORDER BY id $order";
        $query = $this->query($sql);
        $count = $query->rowCount();
        if ($count != 0) return $query->fetchAll();
        else return false;
    }

    /**
     * lire les entrées de la DB associées à la classe et au paramètre $where
     * 
     * @param $where -> composé de la cible et la valeur recherchée
     */
    public function readWhere($where) {
        $target = $where["target"];
        $value = $where["value"];
        $sql = "SELECT * FROM $this->table WHERE $target = '$value'";
        $query = $this->query($sql);
        $count = $query->rowCount();
        if ($count != 0) return $query->fetchAll();
        else return false;
    }

    /**
     * lire les entrées de la DB de la table stampCat associées à la classe et au paramètre 1 et 2
     * 
     * @param $valueStamp -> valeur du id de l'étampe recherchée
     * @param $valueCat -> valeur du id de la catégorie recherchée
     */
    public function readStampCat($valueStamp = null, $valueCat = null) {
        $and = "";
        $sql = "";

        if($valueStamp == null && $valueStamp == null) {
            return false;
        }elseif($valueStamp == null) {
            $sql = "SELECT * FROM $this->table WHERE $this->catKey = :$this->catKey";
        } else {
            $sql = "SELECT * FROM $this->table WHERE $this->stampKey = :$this->stampKey $and";
        }

        if($valueCat != null) {
            $and = "AND $this->catKey = :$this->catKey";
        }

        $query = $this->prepare($sql);
        $query->bindValue(":$this->stampKey", $valueStamp);
        if($valueStamp != null) $query->bindValue(":$this->stampKey", $valueStamp);
        if($valueCat != null) $query->bindValue(":$this->catKey", $valueCat);
        $query->execute();
        $count = $query->rowCount();
        if ($count != 0) return $query->fetchAll();
        else return false;
    }

    /**
     * lire une entrée de la DB associé à la classe et au paramètre
     * 
     * @param $value -> valeur de clé primaire recherchée
     */
    public function readId($value) {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        $query->bindValue(":$this->primaryKey", $value);
        $query->execute();
        $count = $query->rowCount();
        if ($count != 0) return $query->fetch();
        else header("location: ../../home/error");
    }

    /**
     * enregistrer une entrée dans la DB en utilisant le paramètre pour remplir les champs déterminés dans le "fillable de la classe" associée à la classe
     * 
     * @param $data -> les données provenant souvent d'un formulaire, reçu du controller
     */
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

    /**
     * supprimer une entrée de la DB
     */
    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        $query->bindValue(":$this->primaryKey", $id);
        if($query->execute()) return $id;
        else return $query->errorInfo(); 
    }

    /**
     * supprimer les entrées de la DB de la table stampCat associées à la classe et au paramètre 1 et 2
     * 
     * @param $valueStamp -> valeur du id de l'étampe recherchée
     * @param $valueCat -> valeur du id de la catégorie recherchée
     */
    public function deleteStampCat($valueStamp = null, $valueCat = null) {
        $and = "";
        $sql = "";

        if($valueStamp == null && $valueCat == null) {
            return false;
        }elseif($valueStamp == null) {
            $sql = "DELETE FROM $this->table WHERE $this->catKey = :$this->catKey";
        } else {
            $sql = "DELETE FROM $this->table WHERE $this->stampKey = :$this->stampKey $and";
        }

        if($valueCat != null) {
            $and = "AND $this->catKey = :$this->catKey";
        }

        $query = $this->prepare($sql);
        if($valueStamp != null) $query->bindValue(":$this->stampKey", $valueStamp);
        if($valueCat != null) $query->bindValue(":$this->catKey", $valueCat);
        $query->execute();
    }

    /**
     * mettre à jour une entrée de la DB associé à la classe associée et au paramètre
     * 
     * @param $data -> les données provenant souvent d'un formulaire, reçu du controller
     */
    public function update($data) {
        $data_keys = array_fill_keys($this->fillable, "");
        $data = array_intersect_key($data, $data_keys);
        $set = "";
        $id = $data["id"];
        foreach ($data as $field => $value) $set .= " $field = :$field,"; 
        $set = rtrim($set, ",");
        $sql = "UPDATE $this->table SET $set WHERE $this->primaryKey = :$this->primaryKey";
        $query = $this->prepare($sql);
        foreach ($data as $field => $value) $query->bindValue(":$field", $value);
        if($query->execute()) return $id;
        else return $query->errorInfo(); 
    }
}

?>
