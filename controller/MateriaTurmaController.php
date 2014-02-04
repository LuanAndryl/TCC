<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
//rotegeAcesso::protege(end(explode("/", $_SERVER['PHP_SELF'])), dirname(__FILE__));
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/MateriaTurmaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/MateriaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";

class MateriaTurmaController {

    public function addMateriaTurmaAction() {

        if (!empty($_POST['codProf']) and !empty($_POST['codTurma']) or !empty($_GET['codTurma']) and !empty($_GET['codMateria'])) {
            $codProf = $_POST['codProf'];
            $codTurma = (!isset($_POST['codTurma']) ? $_GET['codTurma'] : $_POST['codTurma']);
            $codMateria = $_GET['codMateria'];

            $matTur = new MateriaTurmaModel();
            $matTur->setCodProf($codProf);
            $matTur->setCodTurma($codTurma);
            $matTur->setCodMateria($codMateria);
            $matTur->create();
            echo "
                <script language='javascript'>
                    alert('Cadastrado com Sucesso !');
                </script>
            ";
            //exit();
        }
        else
            throw new Exception("Falha - faltam Parametros");
    }

    public function editProfMateriaTurmaAction() {
        if (!empty($_POST['radioProf']) and !empty($_GET['codMateria']) and !empty($_POST['codProfSubs']) and !empty($_GET['codTurma'])) {

            $matTur = new MateriaTurmaModel();

            $oldProf = (int) $_POST['radioProf'];
            $newProf = (int) $_POST['codProfSubs'];
            $tur = (int) $_GET['codTurma'];
            $mat = (int) $_GET['codMateria'];

            $matTurByProf = $this->selectMatTurByProfMatTur($tur, $mat, $oldProf);

            foreach ($matTurByProf as $m => $valor) {
                $codMatTur = (int) $valor['codMateriaTurma'];
                $matTur->setCodMateriaTurma($codMatTur);
                $matTur->setCodMateria($mat);
                $matTur->setCodTurma($tur);
                $matTur->setCodProf($newProf);
                $matTur->update();
            }

            protegeAcesso::_redirect("Location: efetuarEditarMateriaTurma.php?codCurso={$_GET['codCurso']}&codMateria={$_GET['codMateria']}&codTurma={$_GET['codTurma']}");
            exit();
        }
        else
            throw new Exception("Falha - faltam Parametros");
    }

    public function addMateriaAllTurmaFromCursoAction() {
        if (!empty($_POST['codProf']) and !empty($_POST['codTurma']) and !empty($_GET['codMateria']) and !empty($_GET['codCurso'])) {
            $turma = new TurmaModel();
            $matTur = new MateriaTurmaModel();

            $codProf = $_POST['codProf'];
            $codMateria = $_GET['codMateria'];
            $turma->read(null, "WHERE codCurso={$_GET['codCurso']}");

            $tur = $turma->getRetorno();

            for ($i = 0; $i < count($tur); $i++) {
                $codTur = (int) $tur[$i]['codTurma'];
                $matTur->setCodProf($codProf);
                $matTur->setCodTurma($codTur);
                $matTur->setCodMateria($codMateria);
                $matTur->create();
            }
        }
        else
            throw new Exception("Falha - faltam Parametros");
    }

    public function deleteMateriaTurmaByProfAction() {
        if (!empty($_POST['codProfDel']) and !empty($_GET['codMateria']) and !empty($_GET['codTurma'])) {
            $prof = $_POST['codProfDel'];
            $mat = $_GET['codMateria'];
            $tur = $_GET['codTurma'];

            $matTurByProf = $this->selectMatTurByProfMatTur($tur, $mat, $prof);

            $matTur = new MateriaTurmaModel();

            $codMatTur = (int) $matTurByProf[0]['codMateriaTurma'];
            $matTur->setCodMateriaTurma($codMatTur);
            $matTur->delete();
            protegeAcesso::_redirect("Location: efetuarEditarMateriaTurma.php?codCurso={$_GET['codCurso']}&codMateria={$_GET['codMateria']}&codTurma={$_GET['codTurma']}");
            exit();
            /*
              if ($matTur->delete()) {
              $endereco = $_SERVER ['REQUEST_URI'];

              protegeAcesso::_redirect("Location: erro.php?back={$endereco}");
              }
             * 
             */
              
             
        }
        else
            throw new Exception("Falha - faltam Parametros");
    }

    public function deleteMateriaTurmaAction() {
        if (!empty($_POST['codMateriaTurma'])) {
            $codMatTur = (int) $_POST['codMateriaTurma'];
            $matTur = new MateriaTurmaModel();
            $matTur->setCodMateriaTurma($codMatTur);
            $matTur->delete();
        }
        else
            throw new Exception("Falha - faltam Parametros");
    }

    public function selectMateriaTurmaAction($param = NULL, $cond = NULL) {

        $matTur = new MateriaTurmaModel();

        if (empty($param) and empty($cond))
            $matTur->read();
        else if (!empty($param) and empty($cond))
            $matTur->read($param);
        else if (empty($param) and !empty($cond))
            $matTur->read(NULL, $cond);
        else
            $matTur->read($param, $cond);

        return ($matTur->getRetorno());
    }

    public function selectProfByMatAndTurmaAction() {

        $turma = $_GET['codTurma'];
        $materia = $_GET['codMateria'];

        $read = new readerSqlModel();
        $read->reader(" SELECT DISTINCT materia.nomeMateria, materia.codMateria, professor.nomeProf, professor.codProf,professor.emailProf,professor.matriculaProf
                        FROM professor, materia, materiaturma, turma
                        WHERE materiaturma.codmateria = materia.codmateria
                        AND materiaturma.codprof = professor.codprof
                        AND materiaturma.codmateria = materia.codmateria
                        AND materia.codmateria ={$materia}
                        AND turma.codTurma ={$turma}
                        
                     ");
        return $read->getRetorno();
    }

    private function selectMatTurByProfMatTur($turma, $materia, $professor) {
        $read = new readerSqlModel();
        $read->reader("SELECT materiaturma.codMateriaTurma, materia.nomeMateria, turma.prefixoturma, turma.moduloturma, professor.nomeprof, materiaTurma.codProf
                            FROM materiaturma, professor, materia, turma
                            WHERE materiaturma.codProf = professor.codProf
                            AND materiaturma.codmateria = materia.codmateria
                            AND materiaturma.codturma = turma.codTurma
                            AND materiaturma.codProf ={$professor}
                            AND materiaturma.codmateria ={$materia}
                            AND materiaturma.codturma ={$turma}
                     ");
        return $read->getRetorno();
    }

    public function selectAction() {
        $codTurma = $_GET['codTurma'];
        $read = new readerSqlModel();
        $read->reader(" SELECT curso.nomeCurso, curso.periodoCurso, curso.codCurso, turma.moduloTurma, turma.prefixoTurma, turma.codTurma, materia.nomeMateria, materia.codMateria, professor.nomeProf, professor.codProf, materiaturma.codMateriaTurma
                        FROM professor, turma, materia, materiaturma, curso
                        WHERE materiaturma.codturma = turma.codturma
                        AND materiaturma.codmateria = materia.codmateria
                        AND materiaturma.codprof = professor.codprof
                        AND curso.codCurso = turma.codCurso
                        AND turma.codTurma ={$codTurma}
                     ");
        return $read->getRetorno();
    }

    public function selectOrderAction() {

        $order = $_POST['order'];

        $read = new readerSqlModel();
        $read->reader(" SELECT curso.nomeCurso,curso.periodoCurso, curso.codCurso, turma.moduloTurma, turma.prefixoTurma, turma.codTurma, materia.nomeMateria, materia.codMateria, professor.nomeProf, professor.codProf, materiaturma.codMateriaTurma
                        FROM professor, turma, materia, materiaturma, curso
                        WHERE materiaturma.codturma = turma.codturma
                        AND materiaturma.codmateria = materia.codmateria
                        AND materiaturma.codprof = professor.codprof
                        AND curso.codCurso = turma.codCurso
                        ORDER BY {$order}
                     ");
        return $read->getRetorno();
    }

}

?>
