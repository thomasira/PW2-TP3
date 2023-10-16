<?php
require_once "./model/Crud.php";

class StampArchive extends Crud {
    public $table = "pw2tp3_stamp_archive";
    public $primaryKey = "id";
    public $fillable = [
        "id", 
        "name", 
        "description", 
        "origin", 
        "year", 
        "customer_user_id", 
        "aspect_id"
    ];
}
