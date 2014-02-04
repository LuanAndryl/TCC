<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/ChamadaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/FrequenciaModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/lib/protegeAcesso.php";

class ChamadaController {
    /*
     * Almoçar e trocar a forma de como o codChamada chega 
     * no atriuto acima :D
     */

    public function addFrequenciaEtAction() {
        if (!empty($_POST['codBarras'])) {

            $codBar = (string) $_POST['codBarras'];

            $aluno = $this->selectAlunoFrequente($codBar);
            if (!empty($aluno)) {
                $chamada = end($this->selectChamada());
                $codChamada = (int) $chamada['codChamada'];

                $codFreq = (int) $aluno[0]['codFrequencia'];

                $frequencia = new FrequenciaModel();
                $frequencia->setCodFrequencia($codFreq);
                $frequencia->getById($codFreq);
                $controle = $frequencia->getRetorno();
                if ($controle[0]['falta'] == '3')
                    $frequencia->updateMeiaFalta();
                if ($controle[0]['falta'] == '2')
                    $frequencia->updatePresente();

                protegeAcesso::_redirect("Location: ?codMateria={$_GET['codMateria']}&codProf={$_GET['codProf']}&codTurma={$_GET['codTurma']}");
            } else {
                ?>
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><i class="icon-remove"></i></strong> Codigo desconhecido - <?php echo $codBar ?>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-remove"></i></strong> Digite Algo
            </div>
            <?php
        }
    }

    public function addFrequenciaAction() {
        if (!empty($_POST['codBarras'])) {

            $codBar = (string) $_POST['codBarras'];

            $aluno = $this->selectAlunoFrequente($codBar);
            
            if (!empty($aluno)) {
                $chamada = end($this->selectChamada());
                $codChamada = (int) $chamada['codChamada'];

                $codFreq = (int) $aluno[0]['codFrequencia'];

                $frequencia = new FrequenciaModel();
                $frequencia->setCodFrequencia($codFreq);
                $frequencia->updatePresente();
                protegeAcesso::_redirect("Location: ?codMateria={$_GET['codMateria']}&codProf={$_GET['codProf']}&codTurma={$_GET['codTurma']}");
            } else {
                ?>
                <div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><i class="icon-remove"></i></strong> Codigo desconhecido - <?php echo $codBar ?>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-remove"></i></strong> Digite Algo
            </div>
            <?php
        }
    }

    public function addChamadaAction() {
        if (!empty($_GET['codProf']) and !empty($_GET['codMateria']) and !empty($_POST['codTurma'])) {

            $codProf = $_GET['codProf'];
            $codMateria = $_GET['codMateria'];
            $codTurma = $_POST['codTurma'];

            $matTur = $this->selectMateriaTurma($codProf, $codTurma, $codMateria);

            $matTur = (int) $matTur[0]['codMateriaturma'];

            $today = date("d.m.Y");
            $today = implode("-", array_reverse(explode(".", $today)));
            $chamada = new ChamadaModel();
            $chamada->setCodMateriaTurma($matTur);
            $chamada->setDataChamada($today);
            $chamada->create();

            $codChamada = (int) $chamada->getRetorno();

            $alunos = $this->selectAlunoByTurmaAction();

            foreach ($alunos as $a => $valor) {
                $codMatricula = (int) $valor['codMatricula'];
                $matMtr = $this->selectMateriaMatriculaMatriculado($codMatricula, $matTur);
                $matMtr = (int) $matMtr[0]['codMateriaMatricula'];
                $frequencia = new FrequenciaModel();
                $frequencia->setCodChamada($codChamada);
                $frequencia->setFalta(3);
                $frequencia->setCodMateriaMatricula($matMtr);
                $frequencia->create();
            }
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectChamada() {
        if (!empty($_GET['codProf']) and !empty($_GET['codMateria']) and !empty($_GET['codTurma'])) {

            $reader = new readerSqlModel();
            $today = date("d.m.Y");
            $today = implode("-", array_reverse(explode(".", $today)));

            $codProf = $_GET['codProf'];
            $codMateria = $_GET['codMateria'];
            $codTurma = $_GET['codTurma'];

            $matTur = $this->selectMateriaTurma($codProf, $codTurma, $codMateria);
            $matTur = (int) $matTur[0]['codMateriaturma'];
            $reader->reader("SELECT * 
                            FROM  chamada
                            WHERE codMateriaTurma ={$matTur}
                            AND dataChamada =  '{$today}'");
            return $reader->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectAlunoSituacaoAction($situacao) {
        $reader = new readerSqlModel();
        $chamada = end($this->selectChamada());
        $codChamada = (int) $chamada['codChamada'];
        $reader->reader("SELECT aluno.nomeAluno, aluno.codAluno, materiamatricula.codmateriamatricula, frequencia.codFrequencia,aluno.codaBar
                        FROM aluno, matricula, materiamatricula, frequencia
                        WHERE aluno.codAluno = matricula.codAluno
                        AND materiamatricula.codmatricula = matricula.codmatricula
                        AND frequencia.codmateriamatricula = materiamatricula.codmateriamatricula
                        AND frequencia.falta ={$situacao}
                        AND frequencia.codChamada ={$codChamada}");
        return $reader->getRetorno();
    }

    public function selectAlunoFrequente($codBar) {
        $reader = new readerSqlModel();
        $chamada = end($this->selectChamada());
        $codChamada = (int) $chamada['codChamada'];
        
        $reader->reader("SELECT aluno.nomeAluno, aluno.codAluno, materiamatricula.codMateriaMatricula, frequencia.codFrequencia
FROM aluno, matricula, materiamatricula, frequencia
WHERE aluno.codAluno = matricula.codAluno
AND materiamatricula.codmatricula = matricula.codmatricula
AND frequencia.codmateriamatricula = materiamatricula.codmateriamatricula
AND aluno.codabar =  '{$codBar}'
AND frequencia.codChamada ={$codChamada}");
        return $reader->getRetorno();
    }

    public function selectMateriaMatriculaMatriculado($codMatricula, $codMatTur) {

        $reader = new readerSqlModel();
        $reader->reader("SELECT *
                                FROM materiamatricula
                                WHERE codMatricula ={$codMatricula}
                                AND codMateriaTurma ={$codMatTur}
                                AND situacao =1");
        return $reader->getRetorno();
    }

    public function selectMateriaTurma($codProf, $codTurma, $codMateria) {

        $reader = new readerSqlModel();
        $reader->reader("SELECT codMateriaturma
                                FROM materiaturma
                                WHERE codProf ={$codProf}
                                AND codTurma ={$codTurma}
                                AND codMateria ={$codMateria}");
        return $reader->getRetorno();
    }

    public function selectTurmaByProfAction() {

        if (!empty($_GET['codProf'])) {

            $codProf = $_GET['codProf'];

            $reader = new readerSqlModel();
            $reader->reader("SELECT turma.moduloTurma, turma.prefixoTurma,turma.codTurma
                            FROM turma, materiaturma, professor
                            WHERE turma.codturma = materiaturma.codturma
                            AND materiaturma.codprof = professor.codprof
                            AND professor.codprof ={$codProf} ");
            return $reader->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectMateriaClassAction($codMat) {

        if (!empty($_GET['codProf'])) {

            $codProf = $_GET['codProf'];

            $reader = new readerSqlModel();
            $reader->reader("SELECT materia.nomeMateria,materia.codMateria,curso.classificacao
                                FROM materia, materiaturma, professor, curso
                                WHERE materiaturma.codmateria = materia.codmateria
                                AND materiaturma.codProf = professor.codprof
                                AND materia.codCurso=curso.codCurso
                                AND professor.codprof ={$codProf} 
                                AND materia.codMateria={$codMat}
                                
                                ");

            return $reader->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectMateriaByProfAction() {

        if (!empty($_GET['codProf'])) {

            $codProf = $_GET['codProf'];

            $reader = new readerSqlModel();
            $reader->reader("SELECT materia.nomeMateria,materia.codMateria
                                FROM materia, materiaturma, professor
                                WHERE materiaturma.codmateria = materia.codmateria
                                AND materiaturma.codProf = professor.codprof
                                AND professor.codprof ={$codProf} ");
            return $reader->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectAlunoByTurmaAction() {
        if (!empty($_POST['codTurma'])) {

            $codTurma = $_POST['codTurma'];

            $reader = new readerSqlModel();
            $reader->reader("SELECT aluno.codAluno, aluno.nomeAluno, aluno.codaBar, matricula.codMatricula
                                FROM turma, matricula, aluno
                                WHERE turma.codTurma = matricula.codTurma
                                AND aluno.codAluno = matricula.codAluno
                                AND turma.codTurma ={$codTurma} ");
            return $reader->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectAulasProfessorAction($codProf) {
        if (!empty($_GET['data'])) {
            $data = $_GET['data'];
            $read = new readerSqlModel();
            $read->reader(" SELECT chamada.dataChamada, turma.prefixoTurma, turma.moduloTurma, curso.nomeCurso, curso.periodoCurso
                            FROM chamada, materiaturma, turma, professor, curso
                            WHERE chamada.codMateriaTurma = materiaturma.codMateriaTurma
                            AND materiaturma.codturma = turma.codTurma
                            AND turma.codCurso = curso.codCurso
                            AND materiaturma.codProf = professor.codProf
                            AND materiaturma.codProf ={$codProf}
                            AND chamada.dataChamada LIKE  '%{$data}%'
                            ");
            return $read->getRetorno();
        }
        else
            throw new Exception("Falha - falta parametros");
    }

    public function selectAllDatasChamadasProfAction($codProf) {
        $read = new readerSqlModel();
        $read->reader(" SELECT chamada.dataChamada
                        FROM chamada, materiaturma, professor
                        WHERE chamada.codMateriaTurma = materiaturma.codMateriaTurma
                        AND materiaturma.codProf = professor.codProf
                        AND materiaturma.codProf ={$codProf}
                            ");
        return $read->getRetorno();
    }

}
?>
