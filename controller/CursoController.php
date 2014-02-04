<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
//require_once $_SERVER['DOCUMENT_ROOT']."app/lib/ProtegeAcesso.php";
//ProtegeAcesso::protege(end(explode("/", $_SERVER['PHP_SELF'])), dirname(__FILE__));
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/CursoModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";
?>
<?php

class CursoController {

    public function addCursoAction() {

        $nome = $_POST['nomeCurso'];
        $periodo = $_POST['periodoCurso'];
        $classificacao = $_POST['classificacao'];

        $curso = new CursoModel();
        $curso->setNomeCurso($nome);
        $curso->setPeriodoCurso($periodo);
        $curso->setClassificacao($classificacao);
        $curso->create();
    }

    public function selectCursoAction($param = NULL, $cond = NULL) {
        $curso = new CursoModel();

        if (empty($param) and empty($cond))
            $curso->read();
        else if (!empty($param) and empty($cond))
            $curso->read($param);
        else if (empty($param) and !empty($cond))
            $curso->read(NULL, $cond);
        else
            $curso->read($param, $cond);

        return ($curso->getRetorno());
    }

    public function editarCursoAction() {

        if (!empty($_POST['nomeCurso']) and !empty($_POST['periodoCurso']) and !empty($_GET['codCurso']) and !empty($_POST['classificacao'])) {
            $nome = (string) $_POST['nomeCurso'];
            $per = (string) $_POST['periodoCurso'];
            $classificacao = (string) $_POST['classificacao'];
            $cod = (int) $_GET['codCurso'];


            $curso = new CursoModel();
            $curso->setCodCurso($cod);
            $curso->setNomeCurso($nome);
            $curso->setPeriodoCurso($per);
            $curso->setClassificacao($classificacao);
            $curso->update();
        }
    }

    public function deletarCursoAction() {
        if (!empty($_GET['codCurso'])) {
            $curso = new CursoModel();
            $cod = $_GET['codCurso'];
            $curso->setCodCurso($cod);
            $curso->delete();
        }
    }

    public function selectCursoTurmaAction() {

        $codTurma = $_GET['codTurma'];

        $read = new readerSqlModel();
        $read->reader(" SELECT nomeCurso, periodoCurso
                        FROM curso, turma
                        WHERE turma.codCurso = curso.codCurso
                        AND turma.codTurma ={$codTurma}
                        ");
        return $read->getRetorno();
    }

    public function selectOrderAction() {

        $order = $_POST['order'];

        $read = new readerSqlModel();
        $read->reader(" SELECT * 
                        FROM curso
                        ORDER BY {$order}
                     ");
        return $read->getRetorno();
    }

}

?>