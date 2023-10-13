<?php
require_once "./model/Crud.php";

class Aspect extends Crud {
    public $table = "pw2tp2_aspect";
    public $primaryKey = "id";
    public $fillable = ["id", "aspect"];
}