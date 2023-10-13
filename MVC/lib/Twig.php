<?php

class Twig {
    static public function render($template, $data = []) {
        $loader = new \Twig\Loader\FilesystemLoader("view");
        $twig = new \Twig\Environment($loader, array("auto_reload" => true/* , "cache" => false */)); /* uncomment on prod */
        $twig->addGlobal("path", ROOT);
        echo $twig->render($template, $data);
    }
}