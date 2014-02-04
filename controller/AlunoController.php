<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/AplicationRoute.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";
//rotegeAcesso::protege(end(explode("/", $_SERVER['PHP_SELF'])), dirname(__FILE__));
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/AlunoModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/MateriaMatriculaModel.php";

class AlunoController {

    public function addAlunoAction() {
        if (!empty($_POST['nomeAluno']) and !empty($_POST['dataNascAluno']) and !empty($_POST['rgAluno']) and !empty($_POST['emailAluno']) and
                !empty($_POST['emailResponsavelAluno']) and !empty($_POST['telefoneR']) and !empty($_POST['status'])) {

            $nomeA = (string) $_POST['nomeAluno'];
            $rgA = (string) $_POST['rgAluno'];
            $emailR = (string) $_POST['emailResponsavelAluno'];
            $emailA = (string) $_POST['emailAluno'];
            $dataNascA = $_POST['dataNascAluno'];
            $telefoneR = (string) $_POST['telefoneR'];
            $sts = (int) $_POST['status'];
            $aluno = new AlunoModel();

            $aluno->setNome($nomeA);
            $aluno->setRgAluno($rgA);
            $aluno->setEmailResponsavelAluno($emailR);
            $limpo = protegeAcesso::limpaRg($rgA);
            $aluno->setSenha($limpo);
            $aluno->setEmailAluno($emailA);
            $aluno->setDataNasceAluno($dataNascA);
            $aluno->setTelefoneResponsavelAluno($telefoneR);
            $aluno->setLogin($emailA);
            $aluno->setStatusAluno($sts);
            $aluno->create();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectAlunoAction($param = NULL, $cond = NULL) {
        $aluno = new AlunoModel();

        if (empty($param) and empty($cond))
            $aluno->read();
        else if (!empty($param) and empty($cond))
            $aluno->read($param);
        else if (empty($param) and !empty($cond))
            $aluno->read(NULL, $cond);
        else
            $aluno->read($param, $cond);

        return ($aluno->getRetorno());
    }

    public function selectAlunoActiveAction($param = NULL, $cond = NULL) {
        $aluno = new AlunoModel();

        if (empty($param) and empty($cond))
            $aluno->readActive();
        else if (!empty($param) and empty($cond))
            $aluno->readActive($param);
        else if (empty($param) and !empty($cond))
            $aluno->readActive(NULL, $cond);
        else
            $aluno->readActive($param, $cond);

        return ($aluno->getRetorno());
    }

    public function selectAlunoInactiveAction($param = NULL, $cond = NULL) {
        $aluno = new AlunoModel();

        if (empty($param) and empty($cond))
            $aluno->readInactive();
        else if (!empty($param) and empty($cond))
            $aluno->readInactive($param);
        else if (empty($param) and !empty($cond))
            $aluno->readInactive(NULL, $cond);
        else
            $aluno->readInactive($param, $cond);

        return ($aluno->getRetorno());
    }

    public function editarAlunoAction() {

        if (!empty($_POST['nomeAluno']) and !empty($_POST['dataNascAluno']) and !empty($_POST['rgAluno']) and !empty($_POST['emailAluno']) and
                !empty($_POST['emailResponsavel']) and !empty($_POST['telefoneResponsavel']) and !empty($_GET['codAluno'])) {

            $nomeA = (string) $_POST['nomeAluno'];
            $rgA = (int) $_POST['rgAluno'];
            $emailR = (string) $_POST['emailResponsavel'];
            $emailA = (string) $_POST['emailAluno'];
            $dataNascA = $_POST['dataNascAluno'];
            $telefoneR = $_POST['telefoneResponsavel'];
            $cod = $_GET['codAluno'];

            $aluno = new AlunoModel();

            $aluno->setNome($nomeA);
            $aluno->setRgAluno($rgA);
            $aluno->setEmailResponsavelAluno($emailR);
            $aluno->setSenha($rgA);
            $aluno->setEmailAluno($emailA);
            $aluno->setDataNasceAluno($dataNascA);
            $aluno->setTelefoneResponsavelAluno($telefoneR);
            $aluno->setLogin($emailA);
            $aluno->setCod($cod);
            $aluno->update();
        }
        else
            throw new Exception("Falha - falta Parametros");
    }

    public function selectAlunoMaterias($codAluno) {
        $read = new readerSqlModel();
        $read->reader("SELECT materia.nomeMateria, aluno.nomeAluno, materia.codMateria, materiaturma.codMateriaTurma, materiamatricula.codMateriaMatricula, matricula.codMatricula, aluno.codAluno, turma.moduloTurma, turma.prefixoTurma, curso.nomeCurso, curso.periodoCurso
                        FROM aluno, matricula, materiaturma, materiamatricula, materia, turma, curso
                        WHERE aluno.codaluno = matricula.codaluno
                        AND matricula.codmatricula = materiamatricula.codmatricula
                        AND materiaturma.codmateriaturma = materiamatricula.codmateriaturma
                        AND materiaturma.codmateria = materia.codmateria
                        AND materia.codcurso = curso.codcurso
                        AND turma.codcurso = curso.codcurso
                        AND materiamatricula.situacao =1
                        AND aluno.codAluno ={$codAluno}
                     ");
        return $read->getRetorno();
    }

    public function desativarAlunoAction() {
        if (!empty($_GET['codAluno']) and !empty($_POST['situacao'])) {
            $matMtr = new MateriaMatriculaModel();
            $aluno = new AlunoModel();

            $cod = $_GET['codAluno'];
            $situacao = $_POST['situacao'];
            $today = date("d.m.Y");
            $today = implode("-", array_reverse(explode(".", $today)));

            $aluno->setCod($cod);
            $codMatMtr = $this->selectAlunoMaterias($cod);

            foreach ($codMatMtr as $c => $valor) {
                $codM =(int) $valor['codMateriaMatricula'];
                $matMtr->setSituacao($situacao);
                $matMtr->setDataSituacao($today);
                $matMtr->setCodMateriaMatricula($codM);
                $matMtr->updateSituacao();
            }
            $aluno->delete();
            protegeAcesso::_redirect('Location: relatorioAlunoInativo.php');
            exit();
        }
        else
            throw new Exception("Falha - Url Errada");
    }

    public function ativarAlunoAction() {
        if (!empty($_GET['codAluno'])) {

            $cod = $_GET['codAluno'];

            $aluno = new AlunoModel();
            $aluno->setCod($cod);
            $aluno->Active();
        }
        else
            throw new Exception("Falha - Url Errada");
    }

    public function selectOrderAtAction() {

        $order = $_POST['order'];

        $read = new readerSqlModel();
        $read->reader(" SELECT * 
                        FROM aluno
                        where statusAluno = 1
                        ORDER BY {$order}
                     ");
        return $read->getRetorno();
    }

    public function selectOrderInAction() {

        $order = $_POST['order'];

        $read = new readerSqlModel();
        $read->reader(" SELECT * 
                        FROM aluno
                        where statusAluno = 2
                        ORDER BY {$order}
                     ");
        return $read->getRetorno();
    }

}

?>
