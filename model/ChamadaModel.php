<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/configModel.php');
/**
 * ChamadaModel presistencia no BD;
 *
 * @author Luan
 */
?>
<?php

class ChamadaModel implements iModelAbstract {

    private $codChamada;
    private $codMateriaTurma;
    private $dataChamada;
    private $conn;
    private $retorno = Array();

    /*
     * Getters and Setters
     */

    private function setRetorno($retrono) {
        $this->retorno = $retrono;
    }

    public function getRetorno() {
        return $this->retorno;
    }

    public function getCodChamada() {
        return $this->codChamada;
    }

    public function setCodChamada($codChamada) {
        $this->codChamada = $codChamada;
    }

    public function getCodMateriaTurma() {
        return $this->codMateriaTurma;
    }

    public function setCodMateriaTurma($codMateriaTurma) {
        $this->codMateriaTurma = $codMateriaTurma;
    }

    public function getDataChamada() {
        return $this->dataChamada;
    }

    public function setDataChamada($dataChamada) {
        $this->dataChamada = $dataChamada;
    }

    public function getConn() {
        return $this->conn;
    }

    public function setConn($conn) {
        $this->conn = $conn;
    }

    /*
     * Getters and Setters
     */

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        $query = "INSERT INTO chamada (dataChamada,codMateriaTurma) ";
        $query .="VALUES (:dataChamada,:codMateriaTurma)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':dataChamada', $this->getDataChamada());
        $stmt->bindValue(':codMateriaTurma', $this->getCodMateriaTurma());
        $stmt->execute();
        $this->setRetorno($this->conn->lastInsertId());
    }

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM chamada";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM chamada";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM chamada {$condition}";
        else
            $query = "SELECT {$sql} FROM chamada {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function update() {
        $query = "UPDATE chamada SET dataChamada=:dataChamada,codMateriaTurma=:codMateriaTurma ";
        $query .= "WHERE codChamada=:codChamada";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':codChamada', $this->getCodChamada());
        $stmt->bindValue(':dataChamada', $this->getDataChamada());
        $stmt->bindValue(':codMateriaTurma', $this->getCodMateriaTurma());
        $stmt->execute();
    }

    public function delete() {
        $stmt = $this->conn->prepare("DELETE FROM chamada WHERE codChamada=:codChamada");
        $stmt->bindValue(':codChamada', $this->getCodChamada());
        $stmt->execute();
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM chamada WHERE codChamada=:codChamada");
        $stmt->bindValue(':codChamada', $this->getCodChamada());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }


}

?>
