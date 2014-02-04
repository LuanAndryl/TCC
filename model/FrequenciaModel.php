<?php

class FrequenciaModel implements iModelAbstractQuebra {

    private $codFrequencia;
    private $codMateriaMatricula;
    private $codChamada;
    private $falta;
    private $conn;
    private $retorno = Array();

    /*
     * Gets and Sets
     */

    public function getRetorno() {
        return $this->retorno;
    }

    private function setRetorno($retorno) {
        $this->retorno = $retorno;
    }

    public function getCodFrequencia() {
        return $this->codFrequencia;
    }

    public function setCodFrequencia($codFrequencia) {
        $this->codFrequencia = $codFrequencia;
    }

    public function getCodMateriaMatricula() {
        return $this->codMateriaMatricula;
    }

    public function setCodMateriaMatricula($codMateriaMatricula) {
        $this->codMateriaMatricula = $codMateriaMatricula;
    }

    public function getCodChamada() {
        return $this->codChamada;
    }

    public function setCodChamada($codChamada) {
        $this->codChamada = $codChamada;
    }

    public function getFalta() {
        return $this->falta;
    }

    public function setFalta($falta) {
        $this->falta = $falta;
    }

    /*
     * Gets and Sets
     */

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        $sql = "INSERT INTO frequencia (codChamada,codMateriaMatricula,falta) VALUES(:codChamada,:codMateriaMatricula,:falta) ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':codChamada', $this->getCodChamada());
        $stmt->bindValue(':codMateriaMatricula', $this->getCodMateriaMatricula());
        $stmt->bindValue(':falta', $this->getFalta());
        $stmt->execute();
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM frequencia WHERE codFrequencia=:codFrequencia");
        $stmt->bindValue(':codFrequencia', $this->getCodFrequencia());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function read($sql = null, $condition = NULL) {
        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM frequencia";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM frequencia";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM frequencia {$condition}";
        else
            $query = "SELECT {$sql} FROM frequencia {$condition}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function update() {
        $sql = "UPDATE frequencia SET codMateriaMatricula=:codMateriaMatricula, falta=:falta,codChamada=:codChamada WHERE codFrequencia=:codFrequencia";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':codFrequencia', $this->getCodFrequencia());
        $stmt->bindValue(':codChamada', $this->getCodChamada());
        $stmt->bindValue(':codMateriaMatricula', $this->getCodMateriaMatricula());
        $stmt->bindValue(':falta', $this->getFalta());
        $stmt->execute();
    }

    public function updateFalta() {
        $sql = "UPDATE frequencia SET falta=:falta WHERE codFrequencia=:codFrequencia";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':falta', 3);
        $stmt->bindValue(':codFrequencia', $this->getCodFrequencia());
        $stmt->execute();
    }

    public function updateMeiaFalta() {
        $sql = "UPDATE frequencia SET falta=:falta WHERE codFrequencia=:codFrequencia";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':falta', 2);
        $stmt->bindValue(':codFrequencia', $this->getCodFrequencia());
        $stmt->execute();
    }

    public function updatePresente() {
        $sql = "UPDATE frequencia SET falta=:falta WHERE codFrequencia=:codFrequencia";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':falta', 1);
        $stmt->bindValue(':codFrequencia', $this->getCodFrequencia());
        $stmt->execute();
    }

}

?>
