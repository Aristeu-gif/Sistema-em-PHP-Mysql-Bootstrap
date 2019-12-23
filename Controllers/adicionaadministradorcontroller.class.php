<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adicionaadministradorcontroller
 *
 * @author aristeu
 */
require_once '../Views/adicionaradministradorview.class.php';

class AdicionaAdministradorController {

    private $administradorView;
    private $administradorModel;
    private $cpfDoAdminLogado;

    function __construct() {

        $this->administradorView = new AdicionarAdministradorView("Administrador");


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
                $this->adicionarAdminitradorNoSistema();
                break;

            case "removerAdministrador":
                $this->removerAdminitradorNoSistema();
                break;

            default:
                break;
        }

        $this->administradorView->displayInterface($this->administradorModel);
    }

    function __destruct() {
        unset($this->administradorView, $this->administradorModel);
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

    private function adicionarAdminitradorNoSistema() {

        $this->administradorModel = $this->administradorView->recebeDadosDaConsultaDeNaoAdministradores();

        if ($this->administradorModel->checaAtributos()) {
            //continua
        } else {
            $this->administradorView->addMensagens($this->administradorModel->getMensagens());

            return;
        }
        $adicionou = $this->administradorModel->insereObjeto();

        if ($adicionou) {
            $this->administradorView->addMensagem("Esse cliente foi adicionado como administrador");
        } else {
            $this->administradorView->addMensagem("Ocorreu um erro. Entre em contato com o suporte");
        }
    }

    private function removerAdminitradorNoSistema() {
        $this->administradorModel = $this->administradorView->recebeDadosDaConsultaDeAdministradores();
        if ($this->administradorModel->checaAtributos()) {
            //continua
        } else {
            $this->administradorView->addMensagens($this->administradorModel->getMensagens());
            return;
        }
        $adicionou = $this->administradorModel->excluiObjeto();
        if ($adicionou) {
            $this->administradorView->addMensagem("Esse administrador foi removido");

            //header("Location: login.php");
        } else {
            $this->administradorView->addMensagem("Ocorreu um erro. Entre em contato com o suporte");
        }
    }

    private function consultaClienteLogado() {

        $consultouUsuario = $this->usuarioModel->buscaObjeto();
        $consultouCliente = $this->clienteModel->buscaObjeto();


        if ($consultouUsuario && $consultouCliente) {
            //continua
        } else {
            $this->administradorView->addMensagem("Ocorreu um erro ao buscar os seus dados pessoais. Contate o responsável.");
        }
    }

}
