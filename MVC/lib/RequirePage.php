<?php

class RequirePage {
    static public function model($page) {
        return require_once 'model/' . $page . '.php';
    }
    
    static public function redirect($page) {
        header("location:" . ROOT . $page);
    }
}
?>