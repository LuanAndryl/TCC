<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of readerSqlModel
 *
 * @author Luan
 */
class readerSqlModel {

    private $retorno;

    private function setRetorno($retrono) {
        $this->retorno = $retrono;
    }

    public function getRetorno() {
        return $this->retorno;
    }

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function reader($sql) {
        if ($sql != null) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
    }
}

?>
