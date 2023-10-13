<?php
require_once "./model/Crud.php";

class Stamp extends Crud {
    public $table = "pw2tp2_stamp";
    public $primaryKey = "id";
    public $fillable = [
        "id", 
        "name", 
        "description", 
        "origin", 
        "year", 
        "user_id", 
        "aspect_id"
    ];
}