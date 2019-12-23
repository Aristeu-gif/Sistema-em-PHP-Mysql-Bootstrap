<?php

require_once '../Views/viewabstract.class.php';
require_once '../Models/quartomodel.class.php';

class QuartoView extends ViewAbstract {

    public function montaAside() {
        $aside = new htmlAside();

        $aside->setId("colorlib-hero");

        $div = new HtmlDiv();
        $div->setClass("flexslider");


        $ul = new HtmlUl();
        $ul->setClass("slides");

        $li = new HtmlLi();
        $li->setStyle("background-image: url(/PW-MinhaPousada/images/img_bg_5.jpg);");

        $divOverlay = new HtmlDiv();
        $divOverlay->setClass("overlay");
        $li->addElemento($divOverlay);

        $div2 = new HtmlDiv();
        $div2->setClass("container-fluid");

        $div3 = new HtmlDiv();
        $div3->setClass("row");

        $div4 = new HtmlDiv();
        $div4->setClass("col-md-6 col-sm-12 col-md-offset-3 slider-text");

        $div5 = new HtmlDiv();
        $div5->setClass("slider-text-inner slider-text-inner2 text-center");

        $h1 = new HtmlH();
        $h1->setTipo("2");
        $h1->setTexto("Módulo de Quartos");
        $div5->addElemento($h1);

        $h2 = new HtmlH();
        $h2->setTipo("1");
        $h2->setTexto("Bem Vindo!");
        $div5->addElemento($h2);

        $div4->addElemento($div5);
        $div3->addElemento($div4);
        $div2->addElemento($div3);
        $li->addElemento($div2);
        $ul->addElemento($li);
        $div->addElemento($ul);
        $aside->addElemento($div);
        return $aside;
    }

   

    protected function montaForm(QuartoModel $quartoModel) {
        $div1 = new HtmlDiv();
        $div1->setClass("colorlib-contact");

        $div2 = new HtmlDiv();
        $div2->setClass("container");


        $div3 = new HtmlDiv();
        $div3->setClass("row");

        $div4 = new HtmlDiv();
        $div4->setClass("col-md-10 col-md-offset-1 animate-box");

        $form1 = new HtmlForm();
        $form1->setAction("quarto.php");
        $form1->setMethod("post");
        $form1->setName("quarto");

        $div5 = new HtmlDiv();
        $div5->setClass("row form-group");



        //combobox de quartos

        $div5->addElemento($this->comboboxconsultaEButtonConsulta());

        //Consulta

        $div = new HtmlDiv();
        $div->setClass("row form-group");

        $divh = new HtmlDiv();
        $divh->setClass("col-md-12");

        $h = new HtmlH();
        $h->setTipo(3);
        $h->setTexto("Consultar Quarto");

        $divh->addElemento($h);
        $div->addElemento($divh);

        $form1->addElemento($div);


        $div7 = new HtmlDiv();
        $div7->setClass("row form-group");

        $div8 = new HtmlDiv();
        $div8->setClass("col-md-12");

        $label2 = new HtmlLabel();

        $label2->setTexto("* Número do Quarto");

        $input2 = new HtmlInput();
        $input2->setName("quarNumero");
        $input2->setClass("form-control");
        $input2->setPlaceholder("Número identificador do quarto");
        $input2->setType("mumber");
        $input2->setValue($quartoModel->getQuarNumero());

        $div8->addElementos(array($label2, $input2));
        $div7->addElemento($div8);


        $div9 = new HtmlDiv();
        $div9->setClass("row form-group");


        $div10 = new HtmlDiv();
        $div10->setClass("col-md-12");


        $label3 = new HtmlLabel();
        $label3->setTexto("* Nome");

        $input3 = new HtmlInput();
        $input3->setName("quarNome");
        $input3->setClass("form-control");
        $input3->setPlaceholder("Nome do quarto");
        $input3->setType("text");
        $input3->setValue($quartoModel->getQuarNome());

        $div10->addElementos(array($label3, $input3));
        $div9->addElemento($div10);



        $div11 = new HtmlDiv();
        $div11->setClass("row form-group");

        $div12 = new HtmlDiv();
        $div12->setClass("col-md-12");

        $label4 = new HtmlLabel();
        $label4->setTexto("* Descrição");


        $input4 = new HtmlInput();
        $input4->setName("quarDescricao");
        $input4->setClass("form-control");
        $input4->setPlaceholder("Descrição do quarto");
        $input4->setValue($quartoModel->getQuarDescricao());
        $input4->setType("text");


        $div12->addElementos(array($label4, $input4));
        $div11->addElemento($div12);

        //numero do quarto
        $div14 = new HtmlDiv();
        $div14->setClass("row form-group");

        $div15 = new HtmlDiv();
        $div15->setClass("col-md-12");

        $label6 = new HtmlLabel();

        $label6->setTexto("* Quantidade de Hóspedes");

        $input6 = new HtmlInput();
        $input6->setName("quarQtdHospedes");
        $input6->setClass("form-control");
        $input6->setPlaceholder("Número de hóspedes suportados pelo quarto");
        $input6->setType("number");
        $input6->setValue($quartoModel->getQuarQtdeHospedes());

        $div15->addElementos(array($label6, $input6));
        $div14->addElemento($div15);



        $form1->addElementos(array($div5, /* $divDados */ $div7, $div9, $div11, $div14));


        $form1->addElemento($this->montaDivDeBotoes());
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
        $button->setValue("cadastrar");
        $button->setConteudo("Cadastrar");
        $button->setClass("btn btn-primary");

        $div->addElemento($button);

        return $div;
    }

    public function recebeDadosDaEntrada() {

        $quartoModel = new QuartoModel($_POST["quarNumero"], $_POST["quarNome"], $_POST["quarDescricao"], $_POST["quarQtdHospedes"]);
        return $quartoModel;
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
