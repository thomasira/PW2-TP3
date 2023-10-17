<?php

require_once "./model/Crud.php";

class Log extends Crud {
    public $table = "pw2tp3_log";
    public $primaryKey = "id";
    public $fillable = [
        "id",
        "ip_address",
        "date",
        "page",
        "user_name",
        "privilege_id"
    ];
}

?>