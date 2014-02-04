<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/configModel.php');

class MateriaMatriculaModel implements iModelAbstractQuebra {

    private $codMateriaMatricula;
    private $codMateriaTurma;
    private $codMatricula;
    private $notaFinal;
    private $situacao;
    private $dataSituacao;

   public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function getCodMateriaMatricula() {
        return $this->codMateriaMatricula;
    }

    public function setCodMateriaMatricula($codMateriaMatricula) {
        $this->codMateriaMatricula = $codMateriaMatricula;
    }

    public function getCodMateriaTurma() {
        return $this->codMateriaTurma;
    }

    public function setCodMateriaTurma($codMateriaTurma) {
        $this->codMateriaTurma = $codMateriaTurma;
    }

    public function getCodMatricula() {
        return $this->codMatricula;
    }

    public function setCodMatricula($codMatricula) {
        $this->codMatricula = $codMatricula;
    }

    public function getNotaFinal() {
        return $this->notaFinal;
    }

    public function setNotaFinal($notaFinal) {
        $this->notaFinal = $notaFinal;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getDataSituacao() {
        return $this->dataSituacao;
    }

    public function setDataSituacao($dataSituacao) {
        $this->dataSituacao = $dataSituacao;
    }

    public function create() {
        $query = "INSERT into materiamatricula(codMateriaTurma,codMatricula,notaFinal,situacao,dataSituacao) VALUES (:codMateriaTurma,:codMatricula,:notaFinal,:situacao,:dataSituacao) ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codMateriaTurma', $this->getCodMateriaTurma());
        $stmt->bindValue(':codMatricula', $this->getCodMatricula());
        $stmt->bindValue(':notaFinal', $this->getNotaFinal());
        $stmt->bindValue(':situacao', $this->getSituacao());
        $stmt->bindValue(':dataSituacao', $this->getDataSituacao());
        $stmt->execute();
    }

    public function getById() {
        
    }

    public function read($sql = null) {
        
    }

    public function update() {
        $query = "UPDATE materiaMatricula SET codMateriaTurma=:codMateriaTurma,codMatricula=:codMatricula,notaFinal=:notaFinal,situacao=:situacao,dataSituacao=:dataSituacao";
        $query .="WHERE codMateriaMatricula=:codMateriaMatricula";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codMateriaMatricula', $this->getCodMateriaMatricula());
        $stmt->bindValue(':codMateriaTurma', $this->getCodMateriaTurma());
        $stmt->bindValue(':codMatricula', $this->getCodMatricula());
        $stmt->bindValue(':notaFinal', $this->getNotaFinal());
        $stmt->bindValue(':situacao', $this->getSituacao());
        $stmt->bindValue(':dataSituacao', $this->getDataSituacao());
        $stmt->execute();
    }

    public function updateSituacaoAtributos() {
        $query = "UPDATE materiaMatricula SET situacao=:situacao,dataSituacao=:dataSituacao WHERE codMateriaTurma=:codMateriaTurma AND codMatricula=:codMatricula";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codMateriaTurma', $this->getCodMateriaTurma());
        $stmt->bindValue(':codMatricula', $this->getCodMatricula());
        $stmt->bindValue(':situacao', $this->getSituacao());
        $stmt->bindValue(':dataSituacao', $this->getDataSituacao());
        $stmt->execute();
    }

    public function updateSituacao() {
        $query = "UPDATE materiaMatricula SET situacao=:situacao,dataSituacao=:dataSituacao WHERE codMateriaMatricula=:codMateriaMatricula";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codMateriaMatricula', $this->getCodMateriaMatricula());
        $stmt->bindValue(':situacao', $this->getSituacao());
        $stmt->bindValue(':dataSituacao', $this->getDataSituacao());
        $stmt->execute();
    }


}

?>
