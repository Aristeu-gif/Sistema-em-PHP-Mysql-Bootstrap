<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administradorviewadicionaradministrador
 *
 * @author aristeu
 */
require_once '../Views/administradorview.class.php';
require_once '../Models/administradoresmodel.class.php';
require_once '../Models/clientemodel.class.php';

class AdicionarAdministradorView extends AdministradorView {

    protected function montaForm(AdministradoresModel $administradorModel = null) {
        $div1 = new HtmlDiv();
        $div1->setClass("colorlib-contact");

        $div2 = new HtmlDiv();
        $div2->setClass("container");


        $div3 = new HtmlDiv();
        $div3->setClass("row");

        $div4 = new HtmlDiv();
        $div4->setClass("col-md-10 col-md-offset-1 animate-box");

        $form1 = new HtmlForm();
        $form1->setAction("adicionaadministrador.php");
        $form1->setMethod("post");
        $form1->setName("Administrador");


        //adicionar admin

        $div5 = new HtmlDiv();
        $div5->setClass("row form-group");

        //combobox de quartos

        $div5->addElemento($this->comboboxNaoAdministradores());

        //Consulta

        $div = new HtmlDiv();
        $div->setClass("form-group text-center");

        $divh = new HtmlDiv();
        $divh->setClass("col-md-12");

        $h = new HtmlH();
        $h->setTipo(3);
        $h->setTexto("Adicionar um Administrador");

        $divh->addElemento($h);
        $div->addElemento($divh);
        $form1->addElemento($this->montaDivisao());
        $form1->addElemento($div);



        $div5->addElemento($this->montaDivDeBotaoAdicionarAdmin());

        //remover adminb

        $div6 = new HtmlDiv();
        $div6->setClass("row form-group");

        $div7 = new HtmlDiv();
        $div7->setClass("form-group text-center");

        $divh2 = new HtmlDiv();
        $divh2->setClass("col-md-12");

        $h2 = new HtmlH();
        $h2->setTipo(3);
        $h2->setTexto("Remover um Administrador");

        $divh2->addElemento($h2);
        $div7->addElemento($divh2);

        $div6->addElemento($div7);
        //combobox de quartos

        $div6->addElemento($this->comboboxAdministradores());


        $form1->addElementos(array($div5, $div6));


        $form1->addElemento($this->montaDivDeBotaoRemoverAdmin());
        $form1->addElementos(array($this->montaDivisao(), $this->montaDivisao()));
        $div4->addElemento($form1);
        $div3->addElemento($div4);
        $div2->addElemento($div3);
        $div1->addElemento($div2);
        return $div1;
    }

    public function montaDivDeBotoes() {
        return null;
    }

    public function montaOptionsDosAdministradores() {
        $options = array();

        $option = new htmlOption(FALSE, "Selecione uma opção.", true, "-1", "Selecione uma opção...");

        $options [] = $option;

        $administradorModel = new AdministradoresModel();

        $administradores = $administradorModel->buscaArrayObjetoComPs();
        if (!empty($administradores)) {

            foreach ($administradores as $administrador) {
                $options [] = new htmlOption(FALSE, null, false, $administrador->getAdmnUsuaCpf(), $administrador->getAdmnUsuaCpf());
            }
        }

        return $options;
    }

    public function montaDivDeBotaoRemoverAdmin() {
        $divButtonRemoverAdmin = new HtmlDiv();
        $divButtonRemoverAdmin->setClass("form-group text-center");

        $buttonAdicionarAdmin = new HtmlButton();
        $buttonAdicionarAdmin->setName("bt");
        $buttonAdicionarAdmin->setType("submit");
        $buttonAdicionarAdmin->setValue("removerAdministrador");
        $buttonAdicionarAdmin->setConteudo("Remover Administrador");
        $buttonAdicionarAdmin->setClass("btn btn-primary");

        $divButtonRemoverAdmin->addElemento($buttonAdicionarAdmin);



        return $divButtonRemoverAdmin;
    }

    public function montaDivDeBotaoAdicionarAdmin() {
        $divButtonRemoverAdmin = new HtmlDiv();
        $divButtonRemoverAdmin->setClass("form-group text-center");

        $buttonAdicionarAdmin = new HtmlButton();
        $buttonAdicionarAdmin->setName("bt");
        $buttonAdicionarAdmin->setType("submit");
        $buttonAdicionarAdmin->setValue("adicionarAdministrador");
        $buttonAdicionarAdmin->setConteudo("Adicionar Administrador");
        $buttonAdicionarAdmin->setClass("btn btn-primary");

        $divButtonRemoverAdmin->addElemento($buttonAdicionarAdmin);



        return $divButtonRemoverAdmin;
    }

    public function comboboxNaoAdministradores() {
        $div11 = new HtmlDiv();
        $div11->setClass("row form-group");

        $div12 = new HtmlDiv();
        $div12->setClass("col-md-12");



        $combo = new HtmlSelect();
        $combo->setName("comboClieUsuaCpf");
        $combo->setClass("form-control");

        $options = $this->montaOptionsDosNaoAdministradores();
        $combo->addElementos($options);

        $div12->addElementos(array($combo));
        $div11->addElemento($div12);


        return $div11;
    }

    public function montaOptionsDosNaoAdministradores() {
        $options = array();

        $option = new htmlOption(FALSE, "Selecione uma opção.", true, "-1", "Selecione uma opção...");

        $options [] = $option;

        $clienteModel = new ClienteModel();

        $clientes = $clienteModel->buscaClientesNaoPresentesNaTabelaAdministradores();
        if (!empty($clientes)) {

            foreach ($clientes as $cliente) {
                $options [] = new htmlOption(FALSE, null, false, $cliente->getClieUsuaCpf(), $cliente->getClieUsuaCpf());
            }
        }

        return $options;
    }

    public function comboboxAdministradores() {
        $div11 = new HtmlDiv();
        $div11->setClass("row form-group");

        $div12 = new HtmlDiv();
        $div12->setClass("col-md-12");



        $combo = new HtmlSelect();
        $combo->setName("comboAdmnUsuaCpf");
        $combo->setClass("form-control");

        $options = $this->montaOptionsDosAdministradores();
        $combo->addElementos($options);

        $div12->addElementos(array($combo));
        $div11->addElemento($div12);


        return $div11;
    }

    public function recebeDadosDaConsultaDeAdministradores() {
        $administradorModel = new AdministradoresModel();
        $administradorModel->setAdmnUsuaCpf($_POST["comboAdmnUsuaCpf"]);
        return $administradorModel;
    }

    public function recebeDadosDaConsultaDeNaoAdministradores() {
        $administradorModel = new AdministradoresModel();
        $administradorModel->setAdmnUsuaCpf($_POST["comboClieUsuaCpf"]);
        return $administradorModel;
    }

}
