<?php
require_once "./model/Crud.php";

class Privilege extends Crud {
    public $table = "privilege";
    public $primaryKey = "id";
}