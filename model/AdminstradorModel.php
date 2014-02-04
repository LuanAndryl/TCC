<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/configModel.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/PessoaModel.php');
/*
 * #############################################################
 * #  @author Luan :D                                          #
 * #  @Class AdminstradorModel - persistencia do ADM no banco  #                                           #
 * #############################################################
 *
 */
?>

<?php

class AdminstradorModel extends PessoaModel {
    /*
     * Objeto padrao para a conexao com o Banco
     * @conn
     */

    private $conn;

    /*
     * garante na instanciacao da classe a conexao com o banco 
     */

    public function __construct() {
        $this->conn = ConnectDataBase::conectaBD();
    }

    /*
     * quando o obj da classe for destruido a do obj conexao morre junto
     */

    public function __destruct() {
        ConnectDataBase::conectaBD($this->conn);
    }

    /*
     * Persiste um adminstrador no banco de dados
     * @stmt    variavel de manipulaçao da conexao no metodo;
     * @return  vazio
     */

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO administrador (nomeAdmin,loginAdmin,senhaAdmin) VALUES (:nomeAdmin,:loginAdmin,:senhaAdmin)");
        $stmt->bindValue(':nomeAdmin', $this->getNome());
        $stmt->bindValue(':loginAdmin', $this->getLogin());
        $stmt->bindValue(':senhaAdmin', $this->getSenha());
        $stmt->execute();
    }

    /*
     * busca um array de linhas com os adminstradores do sistema
     * @param    $sql  caso passado, faz um select especifico na tabela;
     * @return    array   @getRetorno;
     */

    public function read($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM administrador";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM administrador";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM administrador {$condition}";
        else
            $query = "SELECT {$sql} FROM administrador {$condition}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function readRow($sql = null, $condition = NULL) {

        if (empty($sql) and empty($condition))
            $query = "SELECT * FROM administrador";
        else if (!empty($sql) and empty($condition))
            $query = "SELECT {$sql} FROM administrador";
        else if (empty($sql) and !empty($condition))
            $query = "SELECT * FROM administrador {$condition}";
        else
            $query = "SELECT {$sql} FROM administrador {$condition}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $this->setRetorno(count($stmt->fetchAll(PDO::FETCH_ASSOC)));
    }

    /*
     * reliza uma atualizaçao nos dados do usuario pelo numero do seu codigo;
     * @return    =  vazio;
     * @param    setCod(); 
     */

    public function update() {
        $stmt = $this->conn->prepare("UPDATE administrador SET nomeAdmin=:nomeAdmin,loginAdmin=:loginAdmin,senhaAdmin=:senhaAdmin WHERE codAdministrador=:codAdmin");
        $stmt->bindValue(':codAdmin', $this->getCod());
        $stmt->bindValue(':nomeAdmin', $this->getNome());
        $stmt->bindValue(':loginAdmin', $this->getLogin());
        $stmt->bindValue(':senhaAdmin', $this->getSenha());
        $stmt->execute();
    }

    /*
     * exclui um usuario apartir do numero do codigo 
     * @param    setCod();
     */

    public function delete() {
        $stmt = $this->conn->prepare("DELETE FROM administrador WHERE codAdministrador=:codAdmin");
        $stmt->bindValue(':codAdmin', $this->getCod());
        $stmt->execute();
    }

    /*
     * Faz a busca de um unico usuario apartir do numero do codigo
     * @param   setCod();
     */

    public function getById() {
        $stmt = $this->conn->prepare("SELECT * FROM administrador WHERE codAdministrador=:codAdmin");
        $stmt->bindValue(':codAdmin', $this->getCod());
        $stmt->execute();
        $this->setRetorno($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    // Vai para as controller //
    private function confInserido() {

        $query = "SELECT nomeAdmin,loginAdmin FROM administrador";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $array = ($stmt->fetchAll(PDO::FETCH_ASSOC));

        $controle = 0;

        foreach ($array as $c => $vale) {
            if (array_search($this->getLogin(), $vale) or array_search($this->getNome(), $vale))
                $controle = $controle + 1;
        }

        if ($controle >= 1)
            return FALSE;
        else
            return TRUE;
    }

    // Vai para as controller //
    /*
     * Faz a instanciacao do objeto de conexao com o banco dados; 
     * Estamos utilizando o PDO que é um driver de conexao nativo do php 
     * para este tipo de abstraçao;
     * 
     * @param    STRCON = string de conexao com o banco de dados; -- 
     * @param    USER = nome do usuario do banco de dados; -- @location model/configModel.php;
     * @param    PASS  = senha para conexao com o BD; -- @location model/configModel.php;
     * @return   @conn = uma instancia de conexao com o banco de dados :D;
     */

}
?>