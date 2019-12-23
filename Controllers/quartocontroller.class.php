<?php

/**
 * Description of discentecontroller
 *
 * @author aluno
 */
require_once '../Views/quartoview.class.php';
require_once '../Views/quartoviewtela2.class.php';
require_once '../Models/quartomodel.class.php';

class QuartoController {

    private $quartoView;
    private $quartoModel;

    function __construct() {

        $this->quartoView = new QuartoView("Quartos");
        $this->quartoModel = new QuartoModel();

        $acao = $this->quartoView->getBt();
       
        switch ($acao) {
            case "cadastrar":
                $this->cadastrarQuarto();
                break;

            case "consulta":
                $this->consultaQuarto();
                break;

            case "altera":
                $this->alteraQuarto();
                break;

            case "exclui":
                $this->excluiQuarto();
                break;

            default:
                break;
        }

        $this->quartoView->displayInterface($this->quartoModel);
    }

    function __destruct() {
        unset($this->quartoView, $this->quartoModel);
    }

    private function cadastrarQuarto() {

        $this->quartoModel = $this->quartoView->recebeDadosDaEntrada();

        if ($this->quartoModel->checaAtributos()) {
            //continua...
        } else {
            $this->quartoView->addMensagens($this->quartoModel->getMensagens());
            return;
        }
        if ($this->quartoModel->buscaObjeto() == 1) {
            $this->quartoView->addMensagem("Já existe um quarto com esse número cadastrado no sistema");
            return;
        }

        $incluiu = $this->quartoModel->insereObjeto();

        if ($incluiu) {
            $this->quartoView->addMensagem("Inclusão bem sucedida!");
        } else {
            $this->quartoView->addMensagem("Inclusão mal sucedida! Contate o responsável.");
        }
    }

    private function consultaQuarto() {
        
    
        $this->quartoModel = $this->quartoView->recebeDadosDaConsulta();
        

        if (is_null($this->quartoModel->getQuarNumero()) || trim($this->quartoModel->getQuarNumero()) == '-1') {
            $this->quartoView->addMensagem("É necessário selecionar o quarto");
            return;
        }
      

        $consultou = $this->quartoModel->buscaObjeto();
        
        

        if ($consultou) {
            $this->quartoView = new QuartoViewTela2("Quartos");
            $this->quartoView->addMensagem("Consulta bem sucedida!");
        } else {
            $this->quartoView->addMensagem("Consulta mal sucedida! Contate o responsável.");
        }
    }

    private function alteraQuarto() {

        $this->quartoModel = $this->quartoView->recebeDadosDaEntrada();
        
        if ($this->quartoModel->checaAtributos()) {
            //continua...
        } else {
            $this->quartoView->addMensagens($this->quartoModel->getMensagens());
            return;
        }


        $alterou = $this->quartoModel->alteraObjeto();
 
        if ($alterou) {
            $this->quartoView->addMensagem("Alteração bem sucedida!");
            $this->quartoModel = new QuartoModel();
        } else {
            $this->quartoView->addMensagem("Alteração mal sucedida! Contate o responsável.");
        }
    }

    private function excluiQuarto() {

        $this->quartoModel = $this->quartoView->recebeDadosDaEntrada();

        if (is_null($this->quartoModel->getQuarNumero()) || trim($this->quartoModel->getQuarNumero()) == '') {
            $this->quartoView->addMensagem("É necessário selecionar o quarto");
            return;
        }

        $excluiu = $this->quartoModel->excluiObjeto();

        if ($excluiu) {
            $this->quartoView->addMensagem("Exclusão bem sucedida!");
            $this->quartoModel = new QuartoModel();
        } else {
            $this->quartoView->addMensagem("Exclusão mal sucedida! Contate o responsável.");
        }
    }

}
