<?php
require_once "./model/Crud.php";

class User extends Crud {
    public $table = "user";
    public $primaryKey = "id";
    public $fillable = ["id", "name", "username", "password", "privilege_id"];


    public function checkUser($username, $password) {
        $sql = "SELECT * FROM $this->table WHERE username = ?";
        $stmt = $this->prepare($sql);
        $stmt->execute([$username]);

        $count = $stmt->rowCount();

        if($count === 1) {
            $user = $stmt->fetch();
            $dbPassword = $user["password"];
            if(password_verify($password, $dbPassword)) {
                session_regenerate_id();
                $_SESSION["username"] = $user["name"];
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["privilege_id"] = $user["privilege_id"];
                $_SESSION["fingerprint"] = md5($_SERVER["HTTP_USER_AGENT"] . $_SERVER["REMOTE_ADDR"]);
                return true;
            } else return false;
        } else return false;
    }
}