<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BDConfig.php';
/*
 * ##########################################
 * #  @author Luan :D                       #
 * #  @Config servidor - Teste PDO          #
 * #  @Oi softwares:D                       #
 * #  @first version 0.0.0 - 03/02/2012     #
 * #  @last version  ?     - ?              #
 * ##########################################
 *
 */

/////////////////////////////////////////////////
/*
 * Constantes que realizao a conexao da Aplicaçao com o banco de dados
 * ultilizando do PDO;
 * mysql:host=localhost;dbname=bd_sogfe
 */

class ConnectDataBase {

    public static function conectaBD() {
        try {
            $conn = new PDO("mysql:host=".SERVER.";dbname=".DBNAME."", USER, PASS);
            return $conn ;
        } catch (PDOException $e) {
            $inst = new InstallController();
            $inst->loadInstallAction();
            
        }
    }

    public static function disconectaBD($conn) {
        unset($conn);
    }

}
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/iModelAbstract.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/model/iModelAbstractQuebra.php';

/*
 * funcao _autoload para carregar os require´s da apliçao
 */
?>