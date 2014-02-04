<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/configModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/InstallModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";

class InstallController {

    public function loadInstallAction() {
        protegeAcesso::_redirect("Location: view/installView/home.php");
        exit();
    }

    public function createBD() {

        $install = new InstallModel();
        $install->installBD();
        protegeAcesso::_redirect("Location: passo2.php");
        exit();
    }

}

?>
