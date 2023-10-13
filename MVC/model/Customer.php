<?php

require_once "./model/Crud.php";

class Customer extends Crud {
    public $table = "pw2tp3_customer"; 
    public $primaryKey = "user_id";
    public $fillable = ["user_id"];
}

?>