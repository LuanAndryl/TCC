<?php

class AuditoriaModel {

    private $codAuditoria;
    private $loginUsuario;
    private $dataAcao;
    private $acao;
    private $arquivo;
    private $nivelUsuario;
    private $retorno = Array();
    private $conn;

    public function getNivelUsuario() {
        return $this->nivelUsuario;
    }

    public function setNivelUsuario($nivelUsuario) {
        $this->nivelUsuario = $nivelUsuario;
    }

    public function getArquivo() {
        return $this->arquivo;
    }

    public function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

    private function setRetorno($retrono) {
        $this->retorno = $retrono;
    }

    public function getRetorno() {
        return $this->retorno;
    }

    public function getCodAuditoria() {
        return $this->codAuditoria;
    }

    public function setCodAuditoria($codAuditoria) {
        $this->codAuditoria = $codAuditoria;
    }

    public function getLoginUsuario() {
        return $this->loginUsuario;
    }

    public function setLoginUsuario($loginUsuario) {
        $this->loginUsuario = $loginUsuario;
    }

    public function getDataAcao() {
        return $this->dataAcao;
    }

    public function setDataAcao($dataAcao) {
        $this->dataAcao = $dataAcao;
    }

    public function getAcao() {
        return $this->acao;
    }

    public function setAcao($acao) {
        $this->acao = $acao;
    }

    // gets and sets

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO auditoria (loginUsuario,arquivo,nivelUsuario,dataAcao,acao) VALUES (:loginUsuario,:arquivo,:nivelUsuario,:dataAcao,:acao)");
        $stmt->bindValue(':loginUsuario', $this->getLoginUsuario());
        $stmt->bindValue(':arquivo', $this->getArquivo());
        $stmt->bindValue(':nivelUsuario', $this->getNivelUsuario());
        $stmt->bindValue(':dataAcao', $this->getDataAcao());
        $stmt->bindValue(':acao', $this->getAcao());
        $stmt->execute();
    }

    public function read($sql = null, $condition = NULL) {
        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM auditoria";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM auditoria";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM auditoria {$condition}";
        else
            $query = "SELECT {$sql} FROM auditoria {$condition}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }


}

?>
