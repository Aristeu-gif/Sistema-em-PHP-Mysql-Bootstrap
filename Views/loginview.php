<?php

require_once '../Views/viewabstract.class.php';
require_once '../Models/clientemodel.class.php';

class LoginView extends ViewAbstract {

    public function montaAside() {
        return null;
    }

    protected function montaForm() {
        $div1 = new HtmlDiv();
        $div1->setClass("colorlib-contact");

        $div2 = new HtmlDiv();
        $div2->setClass("container");


        $div3 = new HtmlDiv();
        $div3->setClass("row");

        $div4 = new HtmlDiv();
        $div4->setClass("col-md-10 col-md-offset-1 animate-box");

        $form1 = new HtmlForm();
        $form1->setAction("login.php");
        $form1->setMethod("post");


        $div = new HtmlDiv();
        $div->setClass("row form-group");

        $divh = new HtmlDiv();
        $divh->setClass("col-md-12");

        $h = new HtmlH();
        $h->setTipo(3);
        $h->setTexto("Login");

        $divh->addElemento($h);
        $div->addElemento($divh);

        $form1->addElemento($div);


        $div14 = new HtmlDiv();
        $div14->setClass("row form-group");

        $div15 = new HtmlDiv();
        $div15->setClass("col-md-6");

        $label6 = new HtmlLabel();

        $label6->setTexto("CPF");

        $input6 = new HtmlInput();
        $input6->setName("usuaCpf");
        $input6->setClass("form-control");
        $input6->setPlaceholder("Seu CPF");
        $input6->setType("text");

        $div15->addElementos(array($label6, $input6));
        $div14->addElemento($div15);

        $div16 = new HtmlDiv();
        $div16->setClass("col-md-6");


        $label7 = new HtmlLabel();

        $label7->setTexto("Senha");

        $input7 = new HtmlInput();
        $input7->setName("usuaSenha");
        $input7->setClass("form-control");
        $input7->setPlaceholder("Sua senha");
        $input7->setType("password");


        $div16->addElementos(array($label7, $input7));
        $div14->addElemento($div16);


        $form1->addElemento($div14);


        $form1->addElemento($this->montaDivDeBotoes());
        $form1->addElemento($this->montaDivisao());
        $div4->addElemento($form1);
        $div3->addElemento($div4);
        $div2->addElemento($div3);
        $div1->addElemento($div2);
        return $div1;
    }

    public function montaDivDeBotoes() {
        $div = new HtmlDiv();
        $div->setClass("form-group text-center");

        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("login");
        $button->setConteudo("Entrar");
        $button->setClass("btn btn-primary");

        $div->addElemento($button);

        return $div;
    }

    public function recebeDadosDaEntrada() {

        $dadosLogin = new stdClass();
        $dadosLogin->usuaCpf = $_POST["usuaCpf"];
        $dadosLogin->usuaSenha = $_POST["usuaSenha"];
        return $dadosLogin;
    }

    public function montaOptionsDosQuartos() {
        $options = array();

        $option = new htmlOption(FALSE, "Selecione uma opção.", true, "-1", "Selecione uma opção...");

        $options [] = $option;

        $quartoModel = new QuartoModel();

        $quartos = $quartoModel->buscaArrayObjetoComPs();
        if (!empty($quartos)) {

            foreach ($quartos as $quarto) {
                $options [] = new htmlOption(FALSE, null, false, $quarto->getQuarNumero(), $quarto->getQuarNome());
            }
        }

        return $options;
    }

    public function recebeDadosDaConsulta() {

        $quartoModel = new QuartoModel();
        $quartoModel->setQuarNumero($_POST["comboBoxQuarNumero"]);

        return $quartoModel;
    }

}
