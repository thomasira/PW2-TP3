<?php
RequirePage::model("Staff");
RequirePage::model("User");
RequirePage::model("Privilege");

class ControllerStaff implements Controller {

    public function __construct() {
        CheckSession::sessionAuth(2);
    }

    /**
     * afficher l'index
     */
    public function index() {
        $staff = new Staff;
        $data["staff"] = $staff->read();
        if($data["staff"]) {
            foreach($data["staff"] as &$employee) {
                $privilege = new Privilege;
                $employee["privilege"] = $privilege->readId($employee["privilege_id"])["privilege"];
            }
        }
        Twig::render("staff/index.php", $data);
    }

    /**
     * afficher le formulaire créer
     */
    public function create() {
        $privilege = new Privilege;
        $data["privileges"] = $privilege->read();
        $data["staff"] = true;
        Twig::render("user/create.php", $data);
    }

    /**
     * supprimer une entrée(staff + user)
     */
    public function delete() {
        if($_SERVER["REQUEST_METHOD"] != "POST"){
            requirePage::redirect("error");
            exit();
        } else {
            CheckSession::sessionAuth(1);
            $id = $_POST["id"];
            $staff = new Staff;
            $staff->delete($id);
            $user = new User;
            $user->delete($id);
            RequirePage::redirect("panel");
        }
    }
}