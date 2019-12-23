<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administrador
 *
 * @author aristeu
 */
require_once '../Views/administradorview.class.php';

require_once '../Controllers/adicionaadministradorcontroller.class.php';

class administradorController {

    private $administradorModel;
    private $administradorView;

    function __construct() {
        $this->administradorView = new AdministradorView("Administrador");
        $this->administradorModel = new AdministradoresModel();

        if ($this->validaSeTaLogado()) {
            $this->administradorModel->setAdmnUsuaCpf($_SESSION["usuaCpf"]);
            if ($this->verificaLoginAdministrador()) {
                
            } else {
                $this->administradorView->addMensagem("É necessário ser administrador para acessar esse módulo");
                $this->administradorView->displayInterface();
                return;
            }
        } else {
            $this->administradorView->addMensagem("Você precisar estar logado");
            $this->administradorView->displayInterface();
            return;
        }

        $acao = $this->administradorView->getBt();
        $this->verificaLoginAdministrador();

        switch ($acao) {
            case "adicionarAdministrador":
                $this->iniciaViewDeAdicionarAdministrador();
                break;

            case "quarto":
                echo "quarto";
                $this->iniciaModuloDequarto();

                break;

            default:
                break;
        }

        $this->administradorView->displayInterface();
    }

    function __destruct() {
        unset($this->administradorView);
    }

    private function validaSeTaLogado() {
        session_start();
        if (isset($_SESSION["usuaCpf"])) {
            return true;
        } else {

            return false;
        }
    }

    private function verificaLoginAdministrador() {

        $buscou = $this->administradorModel->buscaObjeto();
        return $buscou;
    }

    private function iniciaViewDeAdicionarAdministrador() {
        header("Location: adicionaadministrador.php");
    }

    private function iniciaModuloDeQuarto() {
        header("Location: quarto.php");
    }

}
