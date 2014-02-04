<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/configModel.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/PessoaModel.php');
//require_once ('../../model/configModel.php');
//require_once ('../../model/PessoaModel.php');
/**
 * FuncionarioModel presistencia no BD;
 *
 * @author Luan
 */
?>
<?php

class FuncionarioModel extends PessoaModel implements iModelAbstract {

    private $conn;

   public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO funcionario (nomeFunc,loginFunc,senhaFunc) VALUES (:nomeFunc,:loginFunc,:senhaFunc)");
        $stmt->bindValue(':nomeFunc', $this->getNome());
        $stmt->bindValue(':loginFunc', $this->getLogin());
        $stmt->bindValue(':senhaFunc', $this->getSenha());
        $stmt->execute();
    }

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM funcionario";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM funcionario";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM funcionario {$condition}";
        else
            $query = "SELECT {$sql} FROM funcionario {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function readRow($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM funcionario";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM funcionario";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM funcionario {$condition}";
        else
            $query = "SELECT {$sql} FROM funcionario {$condition}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno(count($stmt->fetchAll(PDO::FETCH_ASSOC)));
    }

    public function update() {
        $stmt = $this->conn->prepare("UPDATE funcionario SET nomeFunc=:nomeFunc,loginFunc=:loginFunc,senhaFunc=:senhaFunc WHERE codFunc=:codFunc");
        $stmt->bindValue(':codFunc', $this->getCod());
        $stmt->bindValue(':nomeFunc', $this->getNome());
        $stmt->bindValue(':loginFunc', $this->getLogin());
        $stmt->bindValue(':senhaFunc', $this->getSenha());
        $stmt->execute();
    }

    public function delete() {
        $stmt = $this->conn->prepare("DELETE FROM funcionario WHERE codFunc=:codFunc");
        $stmt->bindValue(':codFunc', $this->getCod());
        $stmt->execute();
    }

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM funcionario WHERE codFunc=:codFunc");
        $stmt->bindValue(':codFunc', $this->getCod());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

}

?>
