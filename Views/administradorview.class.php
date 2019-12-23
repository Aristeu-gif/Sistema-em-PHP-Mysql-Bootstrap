<?php

require_once '../Views/viewabstract.class.php';
require_once '../Models/administradoresmodel.class.php';

class AdministradorView extends ViewAbstract {

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
        $form1->setAction("administrador.php");
        $form1->setMethod("post");

        $div = new HtmlDiv();
        $div->setClass("form-group text-center");

        $divh = new HtmlDiv();
        $divh->setClass("col-md-12");

        $h = new HtmlH();
        $h->setTipo(3);
        $h->setTexto("Administrador");

        $divh->addElemento($h);
        $div->addElemento($divh);

        $form1->addElemento($div);


        $form1->addElemento($this->montaDivDeBotoes());
        $form1->addElementos(Array($this->montaDivisao(), $this->montaDivisao(), $this->montaDivisao()));
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
        $button->setValue("adicionarAdministrador");
        $button->setConteudo("Adicionar Administrador");
        $button->setClass("btn btn-primary");

        $div->addElemento($button);

        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("quarto");
        $button->setConteudo("Quartos");
        $button->setClass("btn btn-primary");

        $div->addElemento($button);

        return $div;
    }

    public function recebeDadosDaEntrada() {
        
    }

    public function recebeDadosDaConsulta() {
        
    }

}
