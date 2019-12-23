<?php

require_once '../Views/loginview.php';
require_once '../Models/clientemodel.class.php';
require_once '../Models/usuariomodel.class.php';
require_once '../Views/reservaview.class.php';
require_once '../Controllers/reservacontroller.class.php';


class LoginController {

    private $loginView;

    function __construct() {
        $this->loginView = new LoginView("Login");

        if ($this->validaSeTaLogado()) {
            
            session_destroy();
            $this->loginView->addMensagem("Você foi deslogado com sucesso");
        }
        

        $acao = $this->loginView->getBt();

        switch ($acao) {
            case "login":
                $this->logar();
                break;
        }

        $this->loginView->displayInterface(null);
    }

    function __destruct() {
        unset($this->loginView);
    }

    private function validaSeTaLogado() {
        session_start();
        if (isset($_SESSION["usuaCpf"])) {
            return true;
        } else {

            return false;
        }
    }

    private function logar() {
        // Faz uma verificação a fim de evitar que se inicie as sessões novamente
        // quando já foram iniciadas anteriormente
        if (!session_status() == PHP_SESSION_ACTIVE) {
            $this->loginView->addMensagem("Você já está logado");
        } else {
            $scLogin = $this->loginView->recebeDadosDaEntrada();
            $loginOk = $this->checaLogin($scLogin);

            if ($loginOk) {
                
                if (session_start()) {

                    $_SESSION['logado'] = true;
                    $_SESSION['usuaCpf'] = $scLogin->usuaCpf;
                    $_SESSION['usuaSenha'] = $scLogin->usuaSenha;
                    header("Location: reserva.php");
                } else {
                    $this->loginView->addMensagem("Oh, Ou! Erro no login.");
                }
            } else {
                $this->loginView->addMensagem("Oh, Ou! O CPF ou senha incorretos. Tente novamente.");
            }
        }
    }

    private function checaLogin($scLogin) {
        $usuarioModel = new UsuarioModel();
        $usuarioModel->setUsuaCpf($scLogin->usuaCpf);
        $usuarioModel->setUsuaSenha($scLogin->usuaSenha);
        $buscou = $usuarioModel->buscaUsuarioPorCpfESenha();
        if ($buscou) {
            return true;
        } else {
            return false;
        }
    }

}
