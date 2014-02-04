<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/readerSqlModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/model/configModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/InstallController.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of protegeAcesso
 *
 * @author Luan
 */
class protegeAcesso {

    public static function protege($pagina, $caminho) {

        if (strpos($caminho, 'controller') == true)
            $base = "../view/erro.html";
        if (strpos($caminho, 'model') == true)
            $base = "../view/erro.html";
        if (strpos($caminho, 'lib') == true)
            $base = "../view/erro.html";
        if (strpos($caminho, 'view') == true)
            $base = "../view/erro.html";

        var_dump($pagina);
        echo "<br />";
        var_dump($caminho);

        if (basename($_SERVER["PHP_SELF"]) == $pagina) {
            //header("Location: {$base}");  
        }
    }

    public static function arumaDataHora($data) {
        $data = explode(" ", $data);
        $data[0] = implode("/", array_reverse(explode("-", $data[0])));
        $data[1] = explode(":", $data[1]);
        $data[1][0] = $data[1][0] . "h ";
        $data[1][1] = $data[1][1] . "m ";
        $data[1][2] = $data[1][2] . "s";
        $data[1] = $data[1][0] . $data[1][1] . $data[1][2];
        $data = $data[0] . " " . $data[1];

        return $data;
    }

    public static function limpaRg($rg) {
        $fim = explode(".", $rg);
        $traco = $fim[2];

        $traco = explode("-", $traco);

        $fim = (int) $fim[0] . "" . $fim[1] . "" . $traco[0] . "" . $traco[1];

        return $fim;
    }

    public static function verificaBD() {
        $reader = new readerSqlModel();
        $reader->reader("SHOW TABLES");
        $ver = $reader->getRetorno();
        if (empty($ver)) {
            $inst = new InstallController();
            $inst->loadInstallAction();
        }
    }
    
    public static function _redirect($url) {
        $limpa = explode(" ", $url);
        echo "<meta http-equiv='refresh' content='0;url={$limpa[1]}'>";        
        
    }

} 

?>
