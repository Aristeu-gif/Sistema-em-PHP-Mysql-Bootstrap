<?php

require_once '../Views/viewabstract.class.php';
require_once '../Models/reservasmodel.class.php';
require_once '../Classes/datasehoras.class.php';

class ReservaView extends ViewAbstract {

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

  

    protected function montaForm($reservaModel) {
        $div1 = new HtmlDiv();
        $div1->setClass("colorlib-contact");

        $div2 = new HtmlDiv();
        $div2->setClass("container");


        $div3 = new HtmlDiv();
        $div3->setClass("row");

        $div4 = new HtmlDiv();
        $div4->setClass("col-md-10 col-md-offset-1 animate-box");

        $form1 = new HtmlForm();
        $form1->setAction("reserva.php");
        $form1->setMethod("post");
        $form1->setName("reservas");

        $div5 = new HtmlDiv();
        $div5->setClass("row form-group");





//combobox de quartos

        $div5->addElemento($this->comboboxconsultaEButtonConsulta($reservaModel));

//Consulta

        $div = new HtmlDiv();
        $div->setClass("row form-group");

        $divh = new HtmlDiv();
        $divh->setClass("col-md-12");

        $h = new HtmlH();
        $h->setTipo(3);
        $h->setTexto("Reserva");

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
        $input2->setName("reseQuarNumero");
        $input2->setClass("form-control");
        $input2->setPlaceholder("Número identificador do quarto");
        $input2->setType("mumber");
        $input2->setValue($reservaModel->getReseQuarNumero());

        $div8->addElementos(array($label2, $input2));
        $div7->addElemento($div8);


        $div11 = new HtmlDiv();
        $div11->setClass("row form-group");

        $div12 = new HtmlDiv();
        $div12->setClass("col-md-6");

        $label4 = new HtmlLabel();
        $label4->setTexto("* Data Inicial");


        $input4 = new HtmlInput();
        $input4->setName("reseDataInicial");
        $input4->setClass("form-control");
// $input4->setPlaceholder("Descrição do quarto");
        $input4->setValue($reservaModel->getReseDataInicial());
        $input4->setType("date");


        $div12->addElementos(array($label4, $input4));
        $div11->addElemento($div12);

//numero do quarto

        $div15 = new HtmlDiv();
        $div15->setClass("col-md-6");
        $label6 = new HtmlLabel();

        $label6->setTexto("* Data Final");

        $input6 = new HtmlInput();
        $input6->setName("reseDataFinal");
        $input6->setClass("form-control");
//$input6->setPlaceholder("");
        $input6->setType("date");
        $input6->setValue($reservaModel->getReseDataFinal());

        $div15->addElementos(array($label6, $input6));
        $div11->addElemento($div15);



        $form1->addElementos(array($div5, /* $divDados */ $div7, $div11));


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
        $button->setValue("reservar");
        $button->setConteudo("Reservar");
        $button->setClass("btn btn-primary");

        $div->addElemento($button);

        return $div;
    }

    public function recebeDadosDaEntrada() {
        $dataAtual = DatasEHoras::getDataDoSistemaInvertidaComTraco();
// function __construct($reseClieCpf = null, $reseQuarNumero = null, $reseDataInicial = null, $reseDataFinal = null, $reseData = null)
        $reservaModel = new ReservaModel(null, $_POST["reseQuarNumero"], $_POST["reseDataInicial"], $_POST["reseDataFinal"], $dataAtual);

        return $reservaModel;
    }

    public function montaOptionsDasReservas($reservaModelLogin) {
        $options = array();

        $option = new htmlOption(FALSE, "Selecione uma opção.", true, "-1", "Selecione uma opção...");

        $options [] = $option;

        $reservaModel = new ReservaModel();
        $reservaModel->setReseClieCpf($reservaModelLogin->getReseClieCpf());


        $reservas = $reservaModel->buscaReservasDoUsuarioLogado();

        if (!empty($reservas)) {

            foreach ($reservas as $reserva) {
                $options [] = new htmlOption(FALSE, null, false, ""
                        . "{$reserva->getReseClieCpf()}:"
                        . "{$reserva->getReseQuarNumero()}:"
                        . "{$reserva->getReseDataInicial()}:"
                        . "{$reserva->getReseDataFinal()}:"
                        . "{$reserva->getReseData()}:",
                        "Quarto: {$reserva->getReseQuarNumero()} | Data Inicial: {$reserva->getReseDataInicial()} ");
            }
        }

        return $options;
    }

    public function recebeDadosDaConsulta() {
        $quarNumeroDataInicial = $_POST["comboBoxConsulta"];
        $quarNumeroDataInicialSeparados = explode(":", $quarNumeroDataInicial);

        $reservaModel = new ReservaModel();
        $reservaModel->setReseClieCpf($quarNumeroDataInicialSeparados[0]);
        $reservaModel->setReseQuarNumero($quarNumeroDataInicialSeparados[1]);
        $reservaModel->setReseDataInicial($quarNumeroDataInicialSeparados[2]);
        $reservaModel->setReseDataFinal($quarNumeroDataInicialSeparados[3]);
        $reservaModel->setReseData($quarNumeroDataInicialSeparados[4]);

        return $reservaModel;
    }

    public function comboboxconsultaEButtonConsulta($reservaModel = null) {
        $div11 = new HtmlDiv();
        $div11->setClass("row form-group");

        $div12 = new HtmlDiv();
        $div12->setClass("col-md-6");

        $label4 = new HtmlLabel();

        $label4->setTexto("Reservas");

        $combo = new HtmlSelect();
        $combo->setName("comboBoxConsulta");
        $combo->setClass("form-control");

        $options = $this->montaOptionsDasReservas($reservaModel);
        $combo->addElementos($options);

        $div12->addElementos(array($label4, $combo));
        $div11->addElemento($div12);


        $div13 = new HtmlDiv();
        $div13->setClass("col-md-6");


        $label5 = new HtmlLabel();
        $label5->setTexto("* Campos Obrigatórios");


        $buttonConsulta = new htmlButton();
        $buttonConsulta->setName("bt");
        $buttonConsulta->setValue("consulta");
        $buttonConsulta->setClass("form-control");
        $buttonConsulta->setConteudo("Consulta");
        $buttonConsulta->setType("submit");


        $div13->addElementos(array($label5, $buttonConsulta));
        $div11->addElemento($div13);
        return $div11;
    }

}
