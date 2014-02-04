<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/configModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/MagicModel.php";

class MagicButtonController {
    
    public function makeTheMagicAction() {
        $mag = new MagicModel();
        $mag->insertSQL();
    }
    
}

?>
