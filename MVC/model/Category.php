<?php
require_once "./model/Crud.php";

class Category extends Crud {
    public $table = "pw2tp3_category";
    public $primaryKey = "id";
    public $fillable = ["id", "category"];
}