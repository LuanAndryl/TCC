<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
//rotegeAcesso::protege(end(explode("/", $_SERVER['PHP_SELF'])), dirname(__FILE__));
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/FuncionarioModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/IndexController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";
class FuncionarioController {

    public function addFuncAction() {
        $nome = $_POST['nomeFunc'];
        $login = $_POST['loginFunc'];
        $senha = $_POST['senhaFunc'];

        $func = new FuncionarioModel();
        $func->setNome($nome);
        $func->setLogin($login);
        $func->setSenha($senha);
        $func->create();
    }

    public function selectFuncAction($param = NULL, $cond = NULL) {
        $func = new FuncionarioModel();

        if (empty($param) and empty($cond))
            $func->read();
        else if (!empty($param) and empty($cond))
            $func->read($param);
        else if (empty($param) and !empty($cond))
            $func->read(NULL, $cond);
        else
            $func->read($param, $cond);

        return ($func->getRetorno());
    }

    public function autoEditarFuncAction() {

        if (!empty($_POST['nomeFunc']) and !empty($_POST['loginFunc']) and !empty($_POST['senhaFunc']) and !empty($_POST['codFunc'])) {
            $nome = (string) $_POST['nomeFunc'];
            $login = (string) $_POST['loginFunc'];
            $senha = $_POST['senhaFunc'];
            $cod = (int) $_POST['codFunc'];

            $func = new FuncionarioModel();
            $func->setNome($nome);
            $func->setLogin($login);
            $func->setSenha($senha);
            $func->setCod($cod);
            $index = new IndexController();
            $index->createSession($login, $senha, 'Funcionario');
            $func->update();
            protegeAcesso::_redirect("Location: home.php");
            exit();
        }
    }

    public function editarFuncAction() {

        if (!empty($_POST['nomeFunc']) and !empty($_POST['loginFunc']) and !empty($_POST['senhaFunc']) and !empty($_GET['codFunc'])) {
            $nome = (string) $_POST['nomeFunc'];
            $login = (string) $_POST['loginFunc'];
            $senha = $_POST['senhaFunc'];
            $cod = (int) $_GET['codFunc'];

            $func = new FuncionarioModel();
            $func->setNome($nome);
            $func->setLogin($login);
            $func->setSenha($senha);
            $func->setCod($cod);
            $func->update();
        }
    }

    public function deletarFuncAction() {
        if (!empty($_GET['codFunc'])) {
            $func = new FuncionarioModel();
            $cod = $_GET['codFunc'];
            $func->setCod($cod);
            $func->delete();
        }
    }

}

?>
