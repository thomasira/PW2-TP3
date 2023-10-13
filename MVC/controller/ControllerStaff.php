<?php
RequirePage::model("Staff");
RequirePage::model("Privilege");


class ControllerStaff implements Controller {

    public function index() {
        $staff = new Staff;
        $data["staff"] = $staff->read();
        foreach ($data["staff"] as &$employee) {
            $privilege = new Privilege;
            $employee["privilege"] = $privilege->readId($employee["id"]);
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