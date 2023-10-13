<?php

class ControllerHome implements Controller {

    public function index() {
        Twig::render("home-index.php");
    }

    public function error() {
        Twig::render("error.php");
    }
}