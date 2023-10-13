<?php
RequirePage::model("Client");
RequirePage::model("City");

class ControllerClient implements Controller {


    public function __construct() {
        CheckSession::sessionAuth();
    }

    public function index() {
        $client = new Client;
        $read = $client->read();
        $data = ["clients" => $read];
        Twig::render("client-index.php", $data);
    }

    public function create() {
        if($_SESSION["privilege_id"] != "1") {
            RequirePage::redirect("client");
            exit();
        }
        $city = new City;
        $read = $city->read();
        $data =  ["cities" => $read];
        Twig::render("client-create.php", $data);
    }

    public function delete() {
        $client = new Client;
        $delete = $client->delete($_POST["id"]);
        if($delete) RequirePage::redirect("client");
        else print_r($delete);
    }
    
    public function store() {
        if($_SERVER["REQUEST_METHOD"] != "POST") {
            RequirePage::redirect("client/create");
            exit();
        }

        RequirePage::library("Validation");
        $val = new Validation;

        extract($_POST);
        $val->name("name")->value($name)->min(4)->max(30)->pattern("alpha")->required();
        $val->name("address")->value($address)->max(50);
        $val->name("zipCode")->value($zipCode)->max(12);
        $val->name("phone")->value($phone)->pattern("tel")->max(20);
        $val->name("email")->value($email)->pattern("email")->max(45);
        $val->name("dob")->value($dob)->pattern("date_mdy");

        
        if($val->isSuccess()) {
            $client = new Client;
            $createdId = $client->create($_POST);
            RequirePage::redirect('client/show/'. $createdId);
        }
        else{
            $city = new City;
            $read = $city->read();
            Twig::render("client-create.php", ["errors" => $val->getErrors(), "client" => $_POST, "cities" => $read]);
        } 
    }

    public function show($id) {
        $client = new Client;
        $readId = $client->readId($id);
        $data = ["client" => $readId];
        Twig::render("client-show.php", $data);
    }

    public function edit($id) {
        $client = new Client; 
        $city = new City;
        $readCity = $city->read();
        $readId = $client->readId($id);
        $data = ["client" => $readId, "cities" => $readCity];
        Twig::render("client-edit.php", $data);
    }

    public function update() {
        $client = new Client;
        $updatedId = $client->update($_POST);
        if($updatedId) RequirePage::redirect('client/show/'. $updatedId);
        else print_r($updatedId);
    }
}