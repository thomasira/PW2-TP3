<?php
RequirePage::model("User");
RequirePage::model("Privilege");

class ControllerUser implements Controller {

    public function index() {
        $user = new User;
        $read = $user->read();
        $data = ["users" => $read];

        foreach($data["users"] as &$user) {
            $id = $user["privilege_id"];
            $privilege = new Privilege;
            $user["privilege"] = $privilege->readId($id)["privilege"];
        }

        Twig::render("user-index.php", $data);
    }

    public function create() {

        $privilege = new Privilege;
        $data["privileges"] = $privilege->read();
        Twig::render("user-create.php", $data);
    }

    public function store() {
        if($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect("user/create");
            exit();
        }

        RequirePage::library("Validation");
        $val = new Validation;

        extract($_POST);
        $val->name("name")->value($name)->pattern("alpha")->min(4)->max(45)->required();
        $val->name("username")->value($username)->pattern("email")->max(45)->required();
        $val->name("password")->value($password)->pattern("alphanum")->min(8)->max(20)->required();
        $val->name("privilege_id")->value($privilege_id)->required();

        if($val->isSuccess()) {

            $options = [
                "cost" => 10
            ];

            $_POST["password"] = password_hash($password, PASSWORD_BCRYPT, $options);
            $user = new User;
            $createdId = $user->create($_POST);
            RequirePage::redirect("user");
        }
        else{
            $privilege = new Privilege;
            $read = $privilege->read();
            Twig::render("user-create.php", ["errors" => $val->getErrors(), "user" => $_POST, "privileges" => $read]);
        } 
    }
}