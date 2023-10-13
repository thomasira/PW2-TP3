<?php
require_once "./model/Crud.php";

class Client extends Crud {
    public $table = "client";
    public $primaryKey = "id";
    public $target = ["client.*", "city"];
    public $tablesMg = ["city"];

    public $fillable = ["id", "name", "address", "zipCode", "phone", "email", "dob", "city_id"];
}