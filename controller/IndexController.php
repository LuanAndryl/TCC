<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
//rotegeAcesso::protege(end(explode("/", $_SERVER['PHP_SELF'])), dirname(__FILE__));
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/FuncionarioModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/AdminstradorModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/AlunoModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/ProfessorModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";
class IndexController {

    public function logoutAction() {
        $strLoad = "index.php";
        $this->destroySessionAction();
        protegeAcesso::_redirect("Location: ../../{$strLoad}");
        exit();
    }
   


    public function loginAction() {
        if (!empty($_POST['login']) and !empty($_POST['senha'])) {

            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $true = $this->trueLogin($login, $senha);
            session_start();
            switch ($true) {
                case 'adm':
                    $this->createSession($login, $senha, 'Adminstrador');
                    protegeAcesso::_redirect("Location: view/admView/home.php");
                    break;
                case 'func':
                    $this->createSession($login, $senha, 'Funcionario');
                    protegeAcesso::_redirect("Location: view/funcionarioView/home.php");
                    break;
                case 'prof':
                    $this->createSession($login, $senha, 'Professor');
                    protegeAcesso::_redirect("Location: view/professorView/home.php");
                    break;
                case 'aln':
                    $this->createSession($login, $senha, 'Aluno');
                    protegeAcesso::_redirect("Location: view/alunoView/home.php");
                    break;
                case 'falha':
                    protegeAcesso::_redirect("Location: index2.php");
                    break;
            }
        } else {
            ?>
            <br />
            <br />
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Ops! :)</strong> Não deixe campos vazios.
            </div>
            <?php
        }
    }

    public function destroySessionAction() {
        if (isset($_SESSION['login']) and isset($_SESSION['senha'])and isset($_SESSION['desc'])) {
            session_unset();
            session_destroy();
        }
    }

    public function createSession($login, $senha, $desc) {
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        $_SESSION['desc'] = $desc;
    }

    private function trueLogin($login, $senha) {
        $adm = new AdminstradorModel();
        $func = new FuncionarioModel();
        $prof = new ProfessorModel();
        $aln = new AlunoModel();

        $adm->readRow(null, "where loginAdmin='{$login}' and senhaAdmin='{$senha}'");
        $func->readRow(null, "where loginFunc='{$login}' and senhaFunc='{$senha}'");
        $prof->readRow(null, "where loginProf='{$login}' and senhaProf='{$senha}'");
        $aln->readRow(null, "where loginAluno='{$login}' and senhaAluno='{$senha}'");

        $controle = 'falha';
        
        
        if ($adm->getRetorno() >= 1  ) {
            $controle = 'adm';
        } else if ($func->getRetorno() >= 1) {
            $controle = 'func';
        } else if ($prof->getRetorno() >= 1) {
            $controle = 'prof';
        } else if ($aln->getRetorno() >= 1) {
            $controle = 'aln';
        }

        return $controle;
    }

}
?>
