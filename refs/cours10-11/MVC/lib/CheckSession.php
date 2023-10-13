<?php

class CheckSession {

    static public function sessionAuth() {
        if(isset($_SESSION["fingerprint"]) && 
        $_SESSION["fingerprint"] == md5($_SERVER["HTTP_USER_AGENT"] . $_SERVER["REMOTE_ADDR"])) return true;
        else RequirePage::redirect("login");
    }
}

//can probably check for privilege id as well, return id