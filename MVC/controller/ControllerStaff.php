<?php
RequirePage::model("Staff");

class ControllerStaff implements Controller {

    public function index() {
        $staff = new Staff;
        $data["staff"] = $staff->read();
        Twig::render("staff/index.php", $data);
    }
}