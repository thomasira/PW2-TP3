<?php

class Twig {
    static public function render($template, $data = []) {
        $loader = new \Twig\Loader\FilesystemLoader("view");
        $twig = new \Twig\Environment($loader, array("auto_reload" => true/* , "cache" => false */)); /* uncomment on prod */
        $twig->addGlobal("path", ROOT);
        $twig->addGlobal("session", $_SESSION);
        if(isset($_SESSION["fingerprint"]) && 
        $_SESSION["fingerprint"] == md5($_SERVER["HTTP_USER_AGENT"] . $_SERVER["REMOTE_ADDR"])) {
            $guest = false;
        }
        else $guest = true;
        $twig->addGlobal("guest", $guest);
        echo $twig->render($template, $data);
    }
}