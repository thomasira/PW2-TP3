<?php
require_once "./model/Crud.php";

class City extends Crud {
    public $table = "city";
    public $primaryKey = "id";
    public $fillable = ["city"];
}