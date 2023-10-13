<?php
require_once "./model/Crud.php";

class StampCategory extends Crud {
    public $table = "pw2tp3_stamp_category";
    public $stampKey = "stamp_id";
    public $catKey = "category_id";
    public $fillable = ["stamp_id", "category_id"];
}