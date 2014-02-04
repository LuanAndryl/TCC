<?php require_once ($_SERVER['DOCUMENT_ROOT'].'/model/configModel.php'); 
/**
 * PessoaModel Generalizaçao das pessoas do sistema; 
 *
 * @author Luan
 */
?>

<?php

abstract class PessoaModel implements imodelAbstract {

    private $cod;
    private $nome;
    private $login;
    private $senha;
    private $retorno = array();

    public function getCod() {
        return $this->cod;
    }

    public function setCod($cod) {
        $this->cod = $cod;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getRetorno() {
        return $this->retorno;
    }

    public function setRetorno($retorno) {
        $this->retorno = $retorno;
    }
    
}
?>