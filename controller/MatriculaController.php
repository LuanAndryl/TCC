<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
//rotegeAcesso::protege(end(explode("/", $_SERVER['PHP_SELF'])), dirname(__FILE__));
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/FuncionarioModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/MatriculaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/MateriaMatriculaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";

class MatriculaController {

    public function addMatriculaAction() {

        if (!empty($_POST['bntMatricular']) and !empty($_GET['codTurma'])) {

            $reader = new readerSqlModel();
            $mtr = new MatriculaModel();
            $matMtr = new MateriaMatriculaModel();

            $codAln = (int) $_POST['bntMatricular'];
            $codTur = (int) $_GET['codTurma'];
            $today = date("d.m.Y");
            $today = implode("-", array_reverse(explode(".", $today)));

            $mtr->setCodAluno($codAln);
            $mtr->setCodTurma($codTur);
            $mtr->create();

            $mtr->read('codMatricula', "where codAluno={$codAln} and codTurma={$codTur}");
            $matricula = $mtr->getRetorno();
            $matricula = (int) $matricula[0]['codMatricula'];

            $reader->reader("SELECT codmateriaturma FROM materiaturma WHERE codTurma='{$codTur}'");
            $matTur = $reader->getRetorno();
            foreach ($matTur as $m => $valor) {
                $codMatTurm = (int) $valor['codmateriaturma'];
                $matMtr->setCodMatricula($matricula);
                $matMtr->setCodMateriaTurma($codMatTurm);
                $matMtr->setDataSituacao($today);
                $matMtr->setSituacao(1);
                $matMtr->create();
            }
            protegeAcesso::_redirect("Location: cadastroMatricula.php?codTurma={$_GET['codTurma']}&codCurso={$_GET['codCurso']}");
            exit();
        }
        else
            throw new Exception("Falha -  Faltam Parametros");
    }

    public function selectCursosDiferentes($codAluno) {
        $read = new readerSqlModel();
        $read->reader("SELECT curso.codCurso
                        FROM matricula, aluno, turma, curso
                        WHERE matricula.codAluno = aluno.codAluno
                        AND matricula.codTurma = turma.codTurma
                        AND turma.codCurso = curso.codCurso
                        AND aluno.codAluno ={$codAluno}
                        ");

        $cursos = $read->getRetorno();

        $false = 0;
        $true = 0;
        $codCurso = $_GET['codCurso'];

        $controle = 0;

        foreach ($cursos as $c => $vale) {
            if (array_search($codCurso, $vale))
                $controle = $controle + 1;
        }

        if ($controle >= 1)
            return FALSE;
        else
            return TRUE;
    }

    public function selectQntMatricula($codAluno) {

        $read = new readerSqlModel();
        $read->reader("SELECT COUNT( aluno.codAluno ) 
                           FROM matricula, aluno, turma, curso
                           WHERE matricula.codAluno = aluno.codAluno
                           AND matricula.codTurma = turma.codTurma
                           AND turma.codCurso = curso.codCurso
                           AND aluno.codAluno = {$codAluno}
                        ");

        return $read->getRetorno();
    }

    public function selectMatriculadoAction($codAluno, $codTurma) {

        $qntMatricula = $this->selectQntMatricula($codAluno);
        $curso = $this->selectCursosDiferentes($codAluno);

        if (($qntMatricula[0]['COUNT( aluno.codAluno )'] < 3) and $curso == true)
            return true;
        else
            return false;
    }

    public function selectMatriculaAction($situacao) {
        if (!empty($_GET['codTurma']) and !empty($situacao) and !empty($_GET['codCurso']) and !empty($_GET['codMateria'])) {
            $read = new readerSqlModel();
            $tur = $_GET['codTurma'];
            $curso = $_GET['codCurso'];
            $codMat = $_GET['codMateria'];

            $read->reader("SELECT aluno.nomeAluno, aluno.codAluno, materiamatricula.situacao, materiamatricula.dataSituacao, materiaturma.codMateriaTurma, materia.nomeMateria, materia.codMateria
FROM aluno, matricula, materiamatricula, materiaturma, materia, turma
WHERE aluno.codAluno = matricula.codMatricula
AND materiamatricula.codMatricula = matricula.codMatricula
AND materiamatricula.codmateriaTurma = materiaturma.codMateriaTurma
AND materiaturma.codMateria = materia.codmateria
                            AND materiamatricula.situacao ={$situacao}
                            AND matricula.codturma = turma.codTurma
                            AND materiaturma.codTurma ={$tur}
                            AND materiaturma.codMateria = {$codMat}
                        ");
            /*
              $read->reader("SELECT materia.nomeMateria, aluno.nomeAluno, materia.codMateria, materiaturma.codMateriaTurma, materiamatricula.codMateriaMatricula, matricula.codMatricula, aluno.codAluno,materiamatricula.dataSituacao
              FROM aluno, matricula, materiaturma, materiamatricula, materia, turma, curso
              WHERE aluno.codaluno = matricula.codaluno
              AND matricula.codmatricula = materiamatricula.codmatricula
              AND materiaturma.codmateriaturma = materiamatricula.codmateriaturma
              AND materiaturma.codmateria = materia.codmateria
              AND materia.codcurso = curso.codcurso
              AND turma.codcurso = curso.codcurso
              AND materiamatricula.situacao ={$situacao}
              AND curso.codCurso = {$curso}
              AND turma.codTurma ={$tur}
              ORDER BY aluno.nomeAluno
              ");
             * 
             */

            return $read->getRetorno();
        }
        else
            throw new Exception("Falha -  Faltam Parametros");
    }

    public function selectEditSituacaoAction($situacao) {
        if (!empty($_GET['codTurma']) and !empty($situacao) and !empty($_GET['codAluno']) and !empty($_GET['codMateria'])) {

            $read = new readerSqlModel();
            $tur = $_GET['codTurma'];
            $materia = $_GET['codMateria'];
            $aluno = $_GET['codAluno'];

            $read->reader("SELECT materia.nomeMateria, aluno.nomeAluno, materia.codMateria, materiaturma.codMateriaTurma, materiamatricula.codMateriaMatricula, matricula.codMatricula, aluno.codAluno, turma.moduloTurma, turma.prefixoTurma, curso.nomeCurso, curso.periodoCurso, materiamatricula.situacao,materiamatricula.dataSituacao
                            FROM aluno, matricula, materiaturma, materiamatricula, materia, turma, curso
                            WHERE aluno.codaluno = matricula.codaluno
                            AND matricula.codmatricula = materiamatricula.codmatricula
                            AND materiaturma.codmateriaturma = materiamatricula.codmateriaturma
                            AND materiaturma.codmateria = materia.codmateria
                            AND materia.codcurso = curso.codcurso
                            AND turma.codcurso = curso.codcurso
                            AND materiamatricula.situacao ={$situacao}
                            AND turma.codTurma ={$tur}
                            AND aluno.codAluno ={$aluno}
                            AND materia.codMateria ={$materia}
                        ");

            return $read->getRetorno();
        }
        else
            throw new Exception("Falha -  Faltam Parametros");
    }

    public function editMatriculaAction() {
        if (!empty($_POST['codMatMtr'])) {
            $codMateriaMatricula = (int) $_POST['codMatMtr'];
            $situacao = (int) $_POST['situacao'];
            $today = date("d.m.Y");
            $today = implode("-", array_reverse(explode(".", $today)));
            $mtr = new MateriaMatriculaModel();
            $mtr->setSituacao($situacao);
            $mtr->setCodMateriaMatricula($codMateriaMatricula);
            $mtr->setDataSituacao($today);
            $mtr->updateSituacao();

            protegeAcesso::_redirect("Location: relatorioMatricula.php?codTurma={$_GET['codTurma']}&codCurso={$_GET['codCurso']}&codMateria={$_GET['codMateria']}&situacao={$_GET['situacao']}");
            exit();
        }
        else
            throw new Exception("Falha -  Faltam Parametros");
    }

}

?>
