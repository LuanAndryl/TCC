<?php

require_once ('../../model/configModel.php');/**
 * TurmaModel presistencia no BD;
 *
 * @author Luan
 */
?>
<?php

class TurmaModel implements imodelAbstract {

    private $moduloTurma;
    private $prefixoTurma;
    private $semestre;
    private $data;
    private $codTurma;
    private $codCurso;
    private $retorno = Array();

    /*
     * Getters and Setter
     */

    public function getSemestre() {
        return $this->semestre;
    }

    public function setSemestre($semestre) {
        $this->semestre = $semestre;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getModuloTurma() {
        return $this->moduloTurma;
    }

    public function setModuloTurma($moduloTurma) {
        $this->moduloTurma = $moduloTurma;
    }

    public function getPrefixoTurma() {
        return $this->prefixoTurma;
    }

    public function setPrefixoTurma($prefixoTurma) {
        $this->prefixoTurma = $prefixoTurma;
    }

    public function getCodTurma() {
        return $this->codTurma;
    }

    public function setCodTurma($codTurma) {
        $this->codTurma = $codTurma;
    }

    public function getCodCurso() {
        return $this->codCurso;
    }

    public function setCodCurso($codCurso) {
        $this->codCurso = $codCurso;
    }

    private function setRetorno($retrono) {
        $this->retorno = $retrono;
    }

    public function getRetorno() {
        return $this->retorno;
    }

    /*
     * Getters and Setter
     */

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO turma (prefixoTurma,moduloTurma,codCurso,semestreTurma,dataTurma) VALUES (:prefixoTurma,:moduloTurma,:codCurso,:semestreTurma,:dataTurma)");
        $stmt->bindValue(':prefixoTurma', $this->getPrefixoTurma());
        $stmt->bindValue(':moduloTurma', $this->getModuloTurma());
        $stmt->bindValue(':semestreTurma', $this->getSemestre());
        $stmt->bindValue(':dataTurma', $this->getData());
        $stmt->bindValue(':codCurso', $this->getCodCurso());
        $stmt->execute();
    }

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM turma";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM turma";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM turma {$condition}";
        else
            $query = "SELECT {$sql} FROM turma {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function update() {
        $stmt = $this->conn->prepare("UPDATE turma SET prefixoTurma=:prefixoTurma ,semestreTurma=:semestreTurma,dataTurma=:dataTurma ,moduloTurma=:moduloTurma , codCurso=:codCurso WHERE codTurma=:codTurma");
        $stmt->bindValue(':codTurma', $this->getCodTurma());
        $stmt->bindValue(':prefixoTurma', $this->getPrefixoTurma());
        $stmt->bindValue(':semestreTurma', $this->getSemestre());
        $stmt->bindValue(':dataTurma', $this->getData());
        $stmt->bindValue(':moduloTurma', $this->getModuloTurma());
        $stmt->bindValue(':codCurso', $this->getCodCurso());
        $stmt->execute();
    }

    public function delete() {
        $stmt = $this->conn->prepare("DELETE FROM turma WHERE codTurma=:codTurma");
        $stmt->bindValue(':codTurma', $this->getCodTurma());
        $stmt->execute();
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM turma WHERE codTurma=:codTurma");
        $stmt->bindValue(':codTurma', $this->getCodTurma());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

}

?>
