<?php

require_once "./model/Crud.php";

class Staff extends Crud {
    public $table = "pw2tp3_staff";
    public $primaryKey = "id";
    public $fillable = ["user_id", "nas"];
}

?>