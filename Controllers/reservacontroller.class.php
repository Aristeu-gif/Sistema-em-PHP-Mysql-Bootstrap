<?php

/**
 * Description of discentecontroller
 *
 * @author aluno
 */
require_once '../Views/reservaview.class.php';
require_once '../Views/reservaviewtela2.class.php';
require_once '../Models/reservasmodel.class.php';
require_once '../Classes/sessao.class.php';

class ReservaController {

    private $reservaView;
    private $reservaModel;
    private $usuaCpf;

    function __construct() {


        $this->reservaView = new ReservaView("Reserva");
        $this->reservaModel = new ReservaModel();

        if ($this->validaSeTaLogado()) {

            $this->reservaModel->setReseClieCpf($_SESSION["usuaCpf"]);
        } else {
            $this->reservaModel->setReseClieCpf(null);
            $this->reservaView->addMensagem("Você precisa estar logado para realizar reservas");
            $this->reservaView->displayInterface($this->reservaModel);
            return;
        }

        $acao = $this->reservaView->getBt();

        switch ($acao) {
            case "reservar":
                $this->reservar();
                break;

            case "consulta":
                $this->consultaReserva();
                break;

            case "cancelarReserva":
                $this->cancelarReserva();
                break;

            default:
                break;
        }

        $this->reservaView->displayInterface($this->reservaModel);
    }

    private function validaSeTaLogado() {
        session_start();
        if (isset($_SESSION["usuaCpf"])) {
            return true;
        } else {

            return false;
        }
    }

    function __destruct() {
        unset($this->reservaView, $this->reservaModel);
    }

    private function reservar() {
        $this->reservaModel->setReseQuarNumero($this->reservaView->recebeDadosDaEntrada()->getReseQuarNumero());
        $this->reservaModel->setReseDataInicial($this->reservaView->recebeDadosDaEntrada()->getReseDataInicial());
        $this->reservaModel->setReseDataFinal($this->reservaView->recebeDadosDaEntrada()->getReseDataFinal());
        $this->reservaModel->setReseData($this->reservaView->recebeDadosDaEntrada()->getReseData());

        if ($this->reservaModel->checaAtributos()) {
            //continua...
        } else {
            $this->reservaView->addMensagens($this->reservaModel->getMensagens());
            return;
        }

        if ($this->reservaModel->verficaSeADataPassadaNoParametroEstaEmUmIntervadoDeDatas($this->reservaModel->getReseDataInicial())) {
            $this->reservaView->addMensagem("A data inicial selecionada está presente em outra reserva. Selecione outra data");
            return;
        }
        if ($this->reservaModel->verficaSeADataPassadaNoParametroEstaEmUmIntervadoDeDatas($this->reservaModel->getReseDataFinal())) {
            $this->reservaView->addMensagem("A data final selecionada está presente em outra reserva. Selecione outra data");
            return;
        }

        $incluiu = $this->reservaModel->insereObjeto();

        if ($incluiu) {
            $this->reservaView->addMensagem("Sua reserva realizada com sucesso");
        } else {
            $this->reservaView->addMensagem("Não foi possível realizar a reserva. Entre em contato com o suporte");
        }
    }

    private function consultaReserva() {


        $this->reservaModel = $this->reservaView->recebeDadosDaConsulta();

        if (is_null($this->reservaModel->getReseQuarNumero()) || trim($this->reservaModel->getReseQuarNumero()) == '-1') {
            $this->reservaView->addMensagem("É necessário selecionar o uma reserva");
            return;
        }

        $consultou = $this->reservaModel->buscaObjeto();


        if ($consultou) {
            $this->reservaView = new ReservaViewTela2("Reserva");
            $this->reservaView->addMensagem("Consulta realizada com sucesso");
        } else {
            $this->reservaView->addMensagem("Ocorreu um erro. Entre em contato com o suporte");
        }
    }

    private function cancelarReserva() {


        $this->reservaModel->setReseQuarNumero($this->reservaView->recebeDadosDaEntrada()->getReseQuarNumero());
        $this->reservaModel->setReseDataInicial($this->reservaView->recebeDadosDaEntrada()->getReseDataInicial());
        $this->reservaModel->setReseDataFinal($this->reservaView->recebeDadosDaEntrada()->getReseDataFinal());
        $this->reservaModel->setReseData($this->reservaView->recebeDadosDaEntrada()->getReseData());

        if ($this->reservaModel->checaAtributos()) {
            //continua...
        } else {
            $this->reservaView->addMensagens($this->reservaModel->getMensagens());
            return;
        }


        $excluiu = $this->reservaModel->excluiObjeto();

        if ($excluiu) {
            $this->reservaView->addMensagem("Cancelamento realizado com sucesso");
            $this->reservaModel = new ReservaModel();
            $this->reservaModel->setReseClieCpf($_SESSION["usuaCpf"]);
        } else {
            $this->reservaView->addMensagem("Erro no cancelamento. Entre em contato com o suporte");
        }
    }

    private function verificaLogin() {
        if (!Sessao::estaLogado()) {
            $this->reservaView->addMensagem("Para realizar a reserva é necessário realizar o login");
            return false;
        } else {
            return true;
        }
    }

}
