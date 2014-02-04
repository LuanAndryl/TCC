<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/AdminstradorModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/IndexController.php";

class AdmistradorController {

    public function addAdmAction() {
        if (!empty($_POST['admNome']) and !empty($_POST['admSenha']) and !empty($_POST['admLogin'])) {
            $nome = (string) $_POST['admNome'];
            $login = (string) $_POST['admLogin'];
            $senha = (string) $_POST['admSenha'];

            $adm = new AdminstradorModel();
            $adm->setLogin($login);
            $adm->setSenha($senha);
            $adm->setNome($nome);
            $adm->create();
            protegeAcesso::_redirect("Location: passo2.php");
            exit();
        }
        else
            throw new Exception("Falha - faltam parametros");
    }

    public function editAdmAction() {
        if (!empty($_POST['admNome']) and !empty($_POST['admSenha']) and !empty($_POST['admLogin']) and !empty($_GET['codAdm'])) {
            $nome = (string) $_POST['admNome'];
            $login = (string) $_POST['admLogin'];
            $senha = (int) $_POST['admSenha'];
            $codAdm = (int) $_GET['codAdm'];
            $adm = new AdminstradorModel();
            $adm->setLogin($login);
            $adm->setSenha($senha);
            $adm->setNome($nome);
            $adm->setCod($codAdm);
            $adm->update();
            protegeAcesso::_redirect("Location: passo2.php");
            exit();
        }
        else
            throw new Exception("Falha - faltam parametros");
    }

    public function delAdmAction() {
        if (!empty($_GET['codAdm'])) {
            
            $codAdm = (int) $_GET['codAdm'];
            $adm = new AdminstradorModel();
            $adm->setCod($codAdm);
            $adm->delete();
            protegeAcesso::_redirect("Location: passo2.php");
            exit();
        }
        else
            throw new Exception("Falha - faltam parametros");
    }

    public function selectAdmAction($param = NULL, $cond = NULL) {
        $adm = new AdminstradorModel();

        if (empty($param) and empty($cond))
            $adm->read();
        else if (!empty($param) and empty($cond))
            $adm->read($param);
        else if (empty($param) and !empty($cond))
            $adm->read(NULL, $cond);
        else
            $adm->read($param, $cond);

        return ($adm->getRetorno());
    }

    public function editarAdministradorAction() {

        if (!empty($_POST['nomeAdmin']) and !empty($_POST['senhaAdmin']) and !empty($_POST['loginAdmin']) and !empty($_POST['codAdministrador'])) {
            $index = new IndexController();
            $nome = (string) $_POST['nomeAdmin'];
            $login = (string) $_POST['loginAdmin'];
            $senha = (string) $_POST['senhaAdmin'];
            $cod = (int) $_POST['codAdministrador'];

            $adm = new AdminstradorModel();
            $adm->setCod($cod);
            $adm->setLogin($login);
            $adm->setSenha($senha);
            $adm->setNome($nome);
            $index->createSession($login, $senha, 'Adminstrador');
            $adm->update();
            protegeAcesso::_redirect("Location: home.php");
            exit();
        }
        else
            throw new Exception("Falha - faltam parametros");
    }

}

?>
