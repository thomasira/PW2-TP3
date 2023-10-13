<?php
RequirePage::model("User");

class ControllerLogin implements Controller {

    public function index() {
        Twig::render("login.php");
    }

    public function auth() {
        if($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect("login");
            exit();
        }

        RequirePage::library("Validation");
        $val = new Validation;

        extract($_POST);
        $val->name("username")->value($username)->pattern("email")->max(45)->required();
        $val->name("password")->value($password)->pattern("alphanum")->min(8)->max(20)->required();

        if($val->isSuccess()) {
            $user = new User;
            if($user->checkUser($username, $password)) RequirePage::redirect("client");
            else RequirePage::redirect("error");
        } else Twig::render("login.php", ["errors" => $val->getErrors(), "user" => $_POST]);
         
    }

    public function logout() {
        session_destroy();
        RequirePage::redirect("login");
    }
}