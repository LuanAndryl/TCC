<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
//rotegeAcesso::protege(end(explode("/", $_SERVER['PHP_SELF'])), dirname(__FILE__));
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/TurmaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";
?>
<?php

class TurmaController {

    public function addTurmaAction() {

        $curso = (int) $_POST['codCurso'];
        $modulo = $_POST['moduloTurma'];
        $prefixo = $_POST['prefixoTurma'];
        $semestre = $_POST['semestre'];
        $today = date("d.m.Y");
        $today = implode("-", array_reverse(explode(".", $today)));
        $turma = new TurmaModel();
        $turma->setCodCurso($curso);
        $turma->setModuloTurma($modulo);
        $turma->setSemestre($semestre);
        $turma->setData($today);
        $turma->setPrefixoTurma($prefixo);
        $turma->create();
    }

    public function selectTurmaAction($param = NULL, $cond = NULL) {
        $turma = new TurmaModel();

        if (empty($param) and empty($cond))
            $turma->read();
        else if (!empty($param) and empty($cond))
            $turma->read($param);
        else if (empty($param) and !empty($cond))
            $turma->read(NULL, $cond);
        else
            $turma->read($param, $cond);

        $retorno = $turma->getRetorno();

        return $retorno;
    }

    public function editarTurmaAction() {

        if (!empty($_POST['opcao']) and !empty($_POST['moduloTurma']) and !empty($_POST['prefixoTurma']) and !empty($_GET['codTurma'])) {
            $curso = (int) $_POST['opcao'];
            $modulo = (string) $_POST['moduloTurma'];
            $prefixo = (string) $_POST['prefixoTurma'];
            $cod = (int) $_GET['codTurma'];


            $turma = new TurmaModel();
            $turma->setCodTurma($cod);
            $turma->setCodCurso($curso);
            $turma->setModuloTurma($modulo);
            $turma->setPrefixoTurma($prefixo);
            $turma->update();
        }
    }

    public function deletarTurmaAction() {

        if (!empty($_GET['codTurma'])) {
            $turma = new TurmaModel();
            $cod = $_GET['codTurma'];
            $turma->setCodTurma($cod);
            $turma->delete();
        }
    }

    public function selectCursoTurmaAllAction() {
        $read = new readerSqlModel();
        $read->reader("SELECT turma.codTurma, turma.moduloTurma, turma.prefixoTurma, curso.periodoCurso, curso.nomeCurso, curso.classificacao, turma.codTurma,curso.codCurso
                        FROM curso, turma
                        WHERE curso.codCurso = turma.codCurso
                        ");
        return $read->getRetorno();
    }

    public function selectCursoTurmaAction($codTurma) {
        $read = new readerSqlModel();
        $read->reader("SELECT turma.codTurma, turma.moduloTurma, turma.prefixoTurma, curso.periodoCurso, curso.nomeCurso, curso.classificacao, turma.codTurma,curso.codCurso
                        FROM curso, turma
                        WHERE curso.codCurso = turma.codCurso
                        AND turma.codTurma={$codTurma}
                        ");
        return $read->getRetorno();
    }

    public function selectReadAction() {
        $read = new readerSqlModel();
        $read->reader("SELECT turma.codTurma, turma.moduloTurma, turma.prefixoTurma, curso.periodoCurso, curso.nomeCurso, curso.classificacao, turma.codTurma,curso.codCurso
                        FROM curso, turma
                        WHERE curso.codCurso = turma.codCurso
                        ");
        return $read->getRetorno();
    }

    public function selectSearchAction() {
        if (!empty($_POST['campo']) and !empty($_POST['txtPesq'])) {

            $campo = $_POST['campo'];
            $condicao = $_POST['txtPesq'];

            $read = new readerSqlModel();

            $read->reader("SELECT turma.codTurma, turma.moduloTurma, turma.prefixoTurma, curso.periodoCurso, curso.nomeCurso, curso.classificacao, turma.codTurma,curso.codCurso
                        FROM curso, turma
                        WHERE curso.codCurso = turma.codCurso AND {$campo}
                        LIKE '%{$condicao}%'
                        ");
            return $read->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectOrderAction() {
        if (!empty($_POST['order'])) {
            $order = $_POST['order'];

            $read = new readerSqlModel();
            $read->reader(" SELECT turma.codTurma, turma.moduloTurma, turma.prefixoTurma, curso.periodoCurso, curso.nomeCurso, curso.classificacao, turma.codTurma,curso.codCurso
                        FROM curso, turma
                        WHERE curso.codCurso = turma.codCurso
                        ORDER BY {$order}
                     ");
            return $read->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

}

?>