<?php

require_once "./model/Crud.php";

class Staff extends Crud {
    public $table = "pw2tp3_staff"; 
    public $primaryKey = "user_id";
    public $fillable = ["user_id", "nas"];

    public function read($order = null) {
        $sql = "SELECT * FROM $this->table INNER JOIN pw2tp3_user ON pw2tp3_user.id = user_id ORDER BY user_id $order";
        $query = $this->query($sql);
        $count = $query->rowCount();
        if ($count != 0) return $query->fetchAll();
        else return false;
    }
}
?>