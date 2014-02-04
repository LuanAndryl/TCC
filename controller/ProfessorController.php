<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
//rotegeAcesso::protege(end(explode("/", $_SERVER['PHP_SELF'])), dirname(__FILE__));
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/ProfessorModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";
?>
<?php

class ProfessorController {

    public function addProfessorAction() {

        if (!empty($_POST['nomeProf']) and !empty($_POST['matriculaProf']) and !empty($_POST['emailProf']) and
                !empty($_POST['senhaProf']) and !empty($_POST['status'])) {

            $nomeP = $_POST['nomeProf'];
            $matricula = $_POST['matriculaProf'];
            $email = $_POST['emailProf'];
            $senha = $_POST['senhaProf'];
            $sts = (int) $_POST['status'];

            $professor = new ProfessorModel();
            $professor->setNome($nomeP);
            $professor->setMatriculaProf($matricula);
            $professor->setEmailProf($email);
            $professor->setLogin($email);
            $professor->setSenha($senha);
            $professor->setStatusProf($sts);
            $professor->create();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectProfessorAction($param = NULL, $cond = NULL) {
        $professor = new ProfessorModel();

        if (empty($param) and empty($cond))
            $professor->read();
        else if (!empty($param) and empty($cond))
            $professor->read($param);
        else if (empty($param) and !empty($cond))
            $professor->read(NULL, $cond);
        else
            $professor->read($param, $cond);

        return ($professor->getRetorno());
    }

    public function selectProfActiveAction($param = NULL, $cond = NULL) {
        $professor = new ProfessorModel();

        if (empty($param) and empty($cond))
            $professor->readActive();
        else if (!empty($param) and empty($cond))
            $professor->readActive($param);
        else if (empty($param) and !empty($cond))
            $professor->readActive(NULL, $cond);
        else
            $professor->readActive($param, $cond);

        return ($professor->getRetorno());
    }

    public function selectProfInactiveAction($param = NULL, $cond = NULL) {
        $professor = new ProfessorModel();

        if (empty($param) and empty($cond))
            $professor->readInactive();
        else if (!empty($param) and empty($cond))
            $professor->readInactive($param);
        else if (empty($param) and !empty($cond))
            $professor->readInactive(NULL, $cond);
        else
            $professor->readInactive($param, $cond);

        return ($professor->getRetorno());
    }

    public function editarProfessorAction() {

        if (!empty($_POST['nomeProf']) and !empty($_POST['senhaProf']) and !empty($_POST['matriculaProf']) and !empty($_POST['emailProf']) and !empty($_GET['codProf'])) {
            $nome = (string) $_POST['nomeProf'];
            $matricula = (int) $_POST['matriculaProf'];
            $email = (string) $_POST['emailProf'];
            $login = (string) $_POST['emailProf'];
            $senha = (string) $_POST['senhaProf'];
            $cod = (int) $_GET['codProf'];

            $professor = new ProfessorModel();
            $professor->setCod($cod);
            $professor->setNome($nome);
            $professor->setMatriculaProf($matricula);
            $professor->setEmailProf($email);
            $professor->setLogin($login);
            $professor->setSenha($senha);
            $professor->update();
        }
        else
            throw new Exception("Falha - faltam parametros");
    }

    public function desativarProfessorAction() {
        if (!empty($_GET['codProf'])) {
            $professor = new ProfessorModel();
            $cod = $_GET['codProf'];
            $professor->setCod($cod);
            $professor->delete();
        }
    }

    public function ativarProfessorAction() {
        if (!empty($_GET['codProf'])) {
            $professor = new ProfessorModel();
            $cod = $_GET['codProf'];
            $professor->setCod($cod);
            $professor->Active();
        }
    }

    public function selectOrderAtAction() {

        $order = $_POST['order'];

        $read = new readerSqlModel();
        $read->reader(" SELECT * 
                        FROM professor
                        WHERE statusProf=1 
                        ORDER BY {$order}
                     ");
        return $read->getRetorno();
    }

    public function selectOrderInAction() {

        $order = $_POST['order'];

        $read = new readerSqlModel();
        $read->reader(" SELECT * 
                        FROM professor
                        WHERE statusProf=2
                        ORDER BY {$order}
                     ");
        return $read->getRetorno();
    }


}

?>