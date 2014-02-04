<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/controller/AuditoriaController.php";

class AplicationRoute {
    /*
     * variavel de instancia da classe
     * @instanceClass 
     */

    private $intanceClass;
    /*
     * recebe a string de controle do arquivo(onde o arquivo esta no projeto)
     * @strConFile
     */
    private $strConFile;
    /*
     * recebe a string que instancia a classe ex: CursoModel();
     * @strConClass
     */
    private $strConClass;
    /*
     * recebe a string que ira chamar o metodo requisitado, na classe ex $instanceClass->deletar();
     * @strConMethod;
     */
    private $strConMethod;
    /*
     * recebe a classe que sera complementada e testada para depois virar : @strConFile e @strConClass 
     * @class
     */
    private $class;
    /*
     * recebe o metodo que sera executado e depois de testavo vira : @strConMethod;
     * @method
     */
    private $method;

    /*
     * testa se os parametros passados via $_GET[] ou $_POST[] existem e sao persistentes no sistema 
     * @testeRoute() 
     */

    private function testRoute() {
        /*
         * concatena a @class e @metohd numa string para ser testada
         */

        if (!empty($_POST['logando']) and $_POST['logando'] == 'ok')
            $this->strConFile = "controller/" . $this->class . "Controller.php";
        else
            $this->strConFile = "../../controller/" . $this->class . "Controller.php";

        $this->strConClass = $this->class . "Controller";
        $this->strConMethod = $this->method . "Action";

        /*
         * verifica se o arquivo existe e o inclui no escopo
         * se nao lança um erro
         */
        if (file_exists($this->strConFile)) {

            require_once $this->strConFile;
        }
        else
            throw new Exception("Falha - Arquivo nao existente");
        /*
         * verifica se a classe existe no escopo e instancia um objeto da classe
         * requisitada;
         * se nao lança um erro
         */
        if (class_exists($this->strConClass)) {
            $this->intanceClass = new $this->strConClass;
        }
        else
            throw new Exception("Falha - Classe nao existente");
        /*
         * Salva os requisicoes do usuario para uma consulta posterior  
         */
        $login = (!empty($_SESSION['login'])) ? $login = $_SESSION['login']  : $login = (!isset($_POST['login'])) ? $login = 'SISTEMA' : $login = $_POST['login'];
        $desc = (!empty($_SESSION['desc'])) ? $desc = $_SESSION['desc']  : $desc = 'Logado sem Atividade';
        AuditoriaController::addAuditoriaAction($login, $this->strConMethod, $this->strConFile,$desc);
    }

    /*
     * getParam();
     * metodo utilizado para pegar dados em geral em metodos select
     * @class       -a classe que sera instanciada
     * @method      -o metodo que sera chamado pela instancia da classe
     * @param       -parametro para a seleçao dos dados 
     * @cond        -condicao para a selecao dos dados
     *              
     * @Exeption    -se o metodo nao for uma instancia da classe ou se ele nao existir; 
     */

    public function getParams($class, $method, $arg1 = NULL, $arg2 = NULL) {
        $this->class = $class;
        $this->method = $method;
        $this->testRoute();
        /*
         * testa se a @instanceClass é uma instancia da classe @strConClass
         */
        if ($this->intanceClass instanceof $this->strConClass) {
            /*
             * testa se @instanceClass é um metodo da classe @strConClass
             */
            if (method_exists($this->intanceClass, $this->strConMethod)) {
                $instanceClass = $this->intanceClass;
                $strConMethod = $this->strConMethod;
                /*
                 * testa se os parametros sao nulos, caso nao sejam o passam para o
                 * metodo do objeto;
                 */
                if (empty($arg1) and empty($arg2))
                    return ( $instanceClass->$strConMethod());
                else if (!empty($arg1) and empty($arg2))
                    return ( $instanceClass->$strConMethod($arg1));
                else if (empty($arg1) and !empty($arg2))
                    return ( $instanceClass->$strConMethod(NULL, $arg2));
                else
                    return ( $instanceClass->$strConMethod($arg1, $arg2));
            }
            /*
             * lança a exeçao se o metodo nao existir;
             */
            else
                throw new Exception("Falha - Metodo nao existente");
        }
        /*
         * lança uma exeçao se o metodo nao for uma instancia da classe;
         */
        else
            throw new Exception("Falha - Nao é uma instancia");
    }

    /*
     * setParam();
     * metodo utilizado para setar entrada e saida de metodos;
     * @class       -a classe que sera instanciada
     * @method      -o metodo que sera chamado pela instancia da classe
     */

    public function setParams($class, $method) {
        $this->class = $class;
        $this->method = $method;
        $this->testRoute();
        /*
         * verifica se a @classe e o @metodo passados existem se nao encaminha para
         * o controlador Index; 
         */
        if (isset($_GET['classe']) or isset($_GET['metodo'])) {
            $class = 'Index';
            $method = 'index';
        }
        /*
         * testa se a @instanceClass é uma instancia da classe @strConClass;
         */
        if ($this->intanceClass instanceof $this->strConClass) {
            /*
             * testa se @instanceClass é um metodo da classe @strConClass
             */
            if (method_exists($this->intanceClass, $this->strConMethod)) {
                $instanceClass = $this->intanceClass;
                $strConMethod = $this->strConMethod;
                return ( $instanceClass->$strConMethod() );
            }
            /*
             * lanca a exeçao se o metodo nao existir;
             */
            else
                throw new Exception("Falha - Metodo nao existente");
        }
        /*
         * lança a exeçao se o metodo nao for uma instancia de classe @strConClass;
         */
        else
            throw new Exception("Falha - Nao é uma instancia");
    }

    /*
     * loadApp()
     * metodo que carrega rapidamente o Index da aplicaçao;
     */

    public function loadApp() {
        /*
         * seta os parametros Index para o redirecionamento
         */
        $this->class = 'Index';
        $this->method = 'index';
        $this->testRoute();
        /*
         * testa se a @instanceClass é uma instancia da classe @strConClass;
         */
        if ($this->intanceClass instanceof $this->strConClass) {
            /*
             * testa se @instanceClass é um metodo da classe @strConClass
             */
            if (method_exists($this->intanceClass, $this->strConMethod)) {
                $instanceClass = $this->intanceClass;
                $strConMethod = $this->strConMethod;
                $instanceClass->$strConMethod();
            }

            /*
             * lanca a exeçao se o metodo nao existir;
             */
            else
                throw new Exception("Falha - Metodo nao existente");
        }
        /*
         * lança a exeçao se o metodo nao for uma instancia de classe @strConClass;
         */
        else
            throw new Exception("Falha - Nao é uma instancia");
    }

}

?>
