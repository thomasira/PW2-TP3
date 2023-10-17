<?php

class View {
    private $data = [];
    private $render = false;

    public function __construct($template) {
        try {
            $file = "view/" . $template . ".php";
            if (file_exists($file)) $this->render = $file;
            else throw new Exception($file . "non trouvé");
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function output($key, $value) {
        $this->data[$key] = $value;
    }

    public function __destruct() {
        extract($this->data);
        include $this->render;
    }
}


?>