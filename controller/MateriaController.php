<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
//rotegeAcesso::protege(end(explode("/", $_SERVER['PHP_SELF'])), dirname(__FILE__));
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/MateriaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";
?>
<?php

class MateriaController {

    public function addMateriaAction() {
        if (!empty($_POST['opcao']) and !empty($_POST['nomeMateria']) and !empty($_POST['ementaMateria'])) {
            $curso = (int) $_POST['opcao'];
            $nomeMateria = (string) $_POST['nomeMateria'];
            $ementa = (string) $_POST['ementaMateria'];

            $materia = new MateriaModel();
            $materia->setCodCurso($curso);
            $materia->setNomeMateria($nomeMateria);
            $materia->setEmentaMateria($ementa);
            var_dump($materia);
            $materia->create();
        }
        else
            throw new Exception("Falha -  Faltam Parametros");
    }

    public function selectMateriaAction($param = NULL, $cond = NULL) {
        $materia = new MateriaModel();

        if (empty($param) and empty($cond))
            $materia->read();
        else if (!empty($param) and empty($cond))
            $materia->read($param);
        else if (empty($param) and !empty($cond))
            $materia->read(NULL, $cond);
        else
            $materia->read($param, $cond);

        return ($materia->getRetorno());
    }

    public function selectMateriaFromTurmaAction($codTurma) {
        $read = new readerSqlModel();
        $read->reader("SELECT materia.nomeMateria, materia.codMateria
                        FROM materia, curso, turma
                        WHERE curso.codCurso = turma.codCurso
                        AND curso.codCurso = materia.codCurso
                        AND turma.codTurma={$codTurma}
                        ");
        return $read->getRetorno();
    }
    
    public function editarMateriaAction() {

        if (!empty($_POST['opcao']) and !empty($_POST['nomeMateria']) and !empty($_POST['nomeMateria']) and !empty($_GET['codMateria']) and !empty($_POST['ementaMateria'])) {

            $curso = (int) $_POST['opcao'];
            $nomeMateria = (string) $_POST['nomeMateria'];
            $ementa = (string) $_POST['ementaMateria'];
            $cod = (int) $_GET['codMateria'];

            $materia = new MateriaModel();

            $materia->setCodMateria($cod);
            $materia->setCodCurso($curso);
            $materia->setNomeMateria($nomeMateria);
            $materia->setEmentaMateria($ementa);
            $materia->update();
        }
        else
            throw new Exception("Falha - Falta Parametros");
    }

    public function deletarMateriaAction() {
        if (!empty($_GET['codMateria'])) {

            $materia = new MateriaModel();

            $cod = $_GET['codMateria'];
            $materia->setCodMateria($cod);
            $materia->delete();
        }
        else
            throw new Exception('Falha - Faltam parametros');
    }

    public function selectReadAction() {
        $read = new readerSqlModel();
        $read->reader("SELECT materia.codMateria, materia.nomeMateria, materia.ementaMateria, curso.periodoCurso, curso.nomeCurso, curso.classificacao, curso.codCurso
                        FROM curso, materia
                        WHERE curso.codCurso = materia.codCurso
                        ");
        return $read->getRetorno();
    }

    public function selectOrderAction() {
        if (!empty($_POST['order'])) {
            $order = $_POST['order'];

            $read = new readerSqlModel();
            $read->reader(" SELECT materia.codMateria, materia.nomeMateria, materia.ementaMateria, curso.periodoCurso, curso.nomeCurso, curso.classificacao, curso.codCurso
                            FROM curso, materia
                            WHERE curso.codCurso = materia.codCurso
                        ORDER BY {$order}
                     ");
            return $read->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectSearchAction() {
        if (!empty($_POST['campo']) and !empty($_POST['txtPesq'])) {

            $campo = $_POST['campo'];
            $condicao = $_POST['txtPesq'];

            $read = new readerSqlModel();

            $read->reader("SELECT materia.codMateria, materia.nomeMateria, materia.ementaMateria, curso.periodoCurso, curso.nomeCurso, curso.classificacao, curso.codCurso
                            FROM curso, materia
                            WHERE curso.codCurso = materia.codCurso AND {$campo}
                            LIKE '%{$condicao}%'
                        ");
            return $read->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

}

?>