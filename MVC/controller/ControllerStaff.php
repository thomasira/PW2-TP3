<?php
RequirePage::model("Staff");
RequirePage::model("Privilege");

class ControllerStaff implements Controller {

    public function __construct() {
        CheckSession::sessionAuth(2);
    }

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

    public function create() {
        $privilege = new Privilege;
        $data["privileges"] = $privilege->read();
        $data["staff"] = true;
        Twig::render("user/create.php", $data);
    }
}