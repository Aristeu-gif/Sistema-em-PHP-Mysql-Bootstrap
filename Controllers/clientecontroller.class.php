<?php

require_once '../Views/clienteview.class.php';
require_once '../Views/clienteviewtela2.class.php';
require_once '../Models/clientemodel.class.php';
require_once '../Classes/cpf.class.php';
require_once '../Models/usuariomodel.class.php';
require_once '../ADOs/bdpdo.class.php';
require_once '../Classes/sessao.class.php';

class ClienteController {

    private $usuarioModel;
    private $clienteModel;
    private $clienteView;
    private $tipoDaView;

    function __construct() {
        $this->clienteView = new ClienteView("Clientes");
        $this->usuarioModel = new UsuarioModel();
        $this->clienteModel = new ClienteModel();



        if ($this->validaSeTaLogado()) {
            $this->usuarioModel->setUsuaCpf($_SESSION["usuaCpf"]);
            $this->clienteModel->setClieUsuaCpf($_SESSION["usuaCpf"]);
            $this->clienteView = new ClienteViewTela2("Clientes");
            $this->consultaClienteLogado();
            $this->tipoDaView = "Edição ou Exclusão";
        } else {

            $this->tipoDaView = "Cadastre-se";
        }

        $acao = $this->clienteView->getBt();

        switch ($acao) {
            case "cadastrar":
                $this->cadastrarCliente();

                break;

            case "consulta":
                $this->consultaCliente();

                break;

            case "altera":
                $this->alteraCliente();

                break;

            case "exclui":
                $this->excluiCliente();

                break;

            case "limpa":

                break;

            default:
                break;
        }

        $this->clienteView->displayInterface($this->usuarioModel, $this->clienteModel, $this->tipoDaView);
    }

    function __destruct() {
        unset($this->clienteView, $this->clienteModel);
    }

    private function validaSeTaLogado() {
        session_start();
        if (isset($_SESSION["usuaCpf"])) {
            return true;
        } else {

            return false;
        }
    }

    private function cadastrarCliente() {

        $this->usuarioModel = $this->clienteView->recebeDadosDaEntrada()[0];
        $this->clienteModel = $this->clienteView->recebeDadosDaEntrada()[1];

        if ($this->usuarioModel->checaAtributos()) {
            //continua
        } else {
            $this->clienteView->addMensagens($this->usuarioModel->getMensagens());
            return;
        }


        if ($this->clienteModel->checaAtributos()) {
            //continua
        } else {
            $this->clienteView->addMensagens($this->clienteModel->getMensagens());
            return;
        }

        $instrucaoUsuario = $this->usuarioModel->montaInsertDoObjetoPS($this->usuarioModel->getNomeDaTabela(), $this->usuarioModel->getArrayDeDadosDaClasse());
        $dadosUsuario = $this->usuarioModel->getArrayDeDadosDaClasse();
        $instrucaoEdadosUsuario = array($instrucaoUsuario, $dadosUsuario);


        $instrucaoCliente = $this->clienteModel->montaInsertDoObjetoPS($this->clienteModel->getNomeDaTabela(), $this->clienteModel->getArrayDeDadosDaClasse());
        $dadosCliente = $this->clienteModel->getArrayDeDadosDaClasse();
        $instrucaoEdadosCliente = array($instrucaoCliente, $dadosCliente);

        if ($this->usuarioModel->buscaObjeto() == 1) {
            $this->clienteView->addMensagem("Já existe um cliente com esse cpf cadastrado no sistema");
            return;
        }
        $inseriu = $this->usuarioModel->executaArrayDePsComTransacaoParaMultiobjetos(array($instrucaoEdadosUsuario, $instrucaoEdadosCliente));

        if ($inseriu) {
            $this->clienteView->addMensagem("Seu cadastro foi realizado com sucesso");
        } else {
            $this->clienteView->addMensagem("Algo deu errado, entre em contato com o suporte");
        }
    }

    private function consultaClienteLogado() {

        //IV - buscar dados do discente no BD
        $consultouUsuario = $this->usuarioModel->buscaObjeto();
        $consultouCliente = $this->clienteModel->buscaObjeto();


        //V - se buscou continua
        //               senão mensagem de erro
        if ($consultouUsuario && $consultouCliente) {
            //continua
        } else {
            $this->clienteView->addMensagem("Ocorreu um erro ao buscar os seus dados pessoais. Contate o responsável.");
        }
    }

    private function consultaCliente() {
        //I - receber dados da view
        $this->clienteModel = $this->clienteView->recebeDadosDaConsulta();
        //II - validar dados

        if (CPF::validaCPF($this->clienteModel->getClieCpf())) {
            //continua...
        } else {
            $this->clienteView->addMensagem("O CPF informado é inválido");
            $this->clienteView->addMensagens($this->clienteModel->getMensagens());
            return;
        }

        //IV - buscar dados do discente no BD
        $consultou = $this->clienteModel->buscaObjeto();

        //V - se buscou continua
        //               senão mensagem de erro
        if ($consultou) {
            $this->clienteView = new ClienteViewTela2("Clientes");
            $this->clienteView->addMensagem("Consulta bem sucedida!");
        } else {
            $this->clienteView->addMensagem("Consulta mal sucedida! Contate o responsável.");
        }
    }

    private function alteraCliente() {

        $this->usuarioModel = $this->clienteView->recebeDadosDaEntrada()[0];
        $this->clienteModel = $this->clienteView->recebeDadosDaEntrada()[1];

        if ($this->usuarioModel->checaAtributos()) {
            //continua
        } else {
            $this->clienteView->addMensagens($this->usuarioModel->getMensagens());
            return;
        }


        if ($this->clienteModel->checaAtributos()) {
            //continua
        } else {
            $this->clienteView->addMensagens($this->clienteModel->getMensagens());
            return;
        }

        $instrucaoUsuario = $this->usuarioModel->montaUpdateDoObjetoPS($this->usuarioModel->getNomeDaTabela(), $this->usuarioModel->getArrayDeDadosDaClasse(), $this->usuarioModel->getUsuaCpf());
        $dadosUsuario = $this->usuarioModel->getArrayDeDadosDaClasse();
        $instrucaoEdadosUsuario = array($instrucaoUsuario, $dadosUsuario);


        $instrucaoCliente = $this->clienteModel->montaUpdateDoObjetoPS($this->clienteModel->getNomeDaTabela(), $this->clienteModel->getArrayDeDadosDaClasse(), $this->clienteModel->getClieUsuaCpf());
        $dadosCliente = $this->clienteModel->getArrayDeDadosDaClasse();
        $instrucaoEdadosCliente = array($instrucaoCliente, $dadosCliente);


        $alterou = $this->usuarioModel->executaArrayDePsComTransacaoParaMultiobjetos(array($instrucaoEdadosUsuario, $instrucaoEdadosCliente));

        if ($alterou) {
            $this->clienteView->addMensagem("Seus dados foram alterados com sucesso");
        } else {
            $this->clienteView->addMensagem("Algo deu errado, entre em contato com o suporte");
        }
    }

    private function excluiCliente() {
        $this->usuarioModel = $this->clienteView->recebeDadosDaEntrada()[0];
        $this->clienteModel = $this->clienteView->recebeDadosDaEntrada()[1];
        $this->usuarioModel->setUsuaCpf($_SESSION["usuaCpf"]);
        $this->clienteModel->setClieUsuaCpf($_SESSION["usuaCpf"]);

        if ($this->usuarioModel->checaAtributos()) {
            //continua
        } else {
            $this->clienteView->addMensagens($this->usuarioModel->getMensagens());
            return;
        }


        if ($this->clienteModel->checaAtributos()) {
            //continua
        } else {
            $this->clienteView->addMensagens($this->clienteModel->getMensagens());
            return;
        }

        // $instrucaoUsuario = $this->usuarioModel->montaUpdateDoObjetoPS($this->usuarioModel->getNomeDaTabela(), $this->usuarioModel->getArrayDeDadosDaClasse(), $this->usuarioModel->getUsuaCpf());
        $instrucaoUsuario = $this->usuarioModel->montaDeleteUsandoAndDoObjetoPS(array('usuaCpf' => $this->usuarioModel->getusuaCpf()));
        $dadosUsuario = $this->usuarioModel->getArrayDeDadosDaClasse();

        $instrucaoEdadosUsuario = array($instrucaoUsuario, $dadosUsuario);



        $instrucaoCliente = $this->clienteModel->montaDeleteUsandoAndDoObjetoPS(array('clieUsuaCpf' => $this->clienteModel->getClieUsuaCpf()));
        $dadosCliente = $this->clienteModel->getArrayDeDadosDaClasse();
        $instrucaoEdadosCliente = array($instrucaoCliente, $dadosCliente);


        $excluiu = $this->usuarioModel->executaArrayDePsComTransacaoParaMultiobjetos(array($instrucaoEdadosCliente, $instrucaoEdadosUsuario));
        
        if ($excluiu) {
            $this->clienteView->addMensagem("Sua conta foi excluida sucesso");
            header("Location: login.php");
        } else {
            $this->clienteView->addMensagem("Algo deu errado, entre em contato com o suporte");
        }
    }

}
