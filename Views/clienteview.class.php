<?php

require_once '../Views/viewabstract.class.php';

require_once '../Models/clientemodel.class.php';

class ClienteView extends ViewAbstract {

    protected function montaFieldsetConsulta() {
        return null;
    }

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
        $h1->setTexto("Seja nosso cliente");
        $div5->addElemento($h1);

        $h2 = new HtmlH();
        $h2->setTipo("1");
        $h2->setTexto("Cadastre-se");
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

   

    protected function montaForm($usuarioModel, $clienteModel, $tipoDaView) {
        $div1 = new HtmlDiv();
        $div1->setClass("colorlib-contact");

        $div2 = new HtmlDiv();
        $div2->setClass("container");


        $div3 = new HtmlDiv();
        $div3->setClass("row");

        $div4 = new HtmlDiv();
        $div4->setClass("col-md-10 col-md-offset-1 animate-box");

        $form1 = new HtmlForm();
        $form1->setAction("cliente.php");
        $form1->setMethod("post");

        $div5 = new HtmlDiv();
        $div5->setClass("row form-group");

        $div = new HtmlDiv();
        $div->setClass("row form-group");

        $divh = new HtmlDiv();
        $divh->setClass("col-md-12");

        $h = new HtmlH();
        $h->setTipo(3);
        $h->setTexto($tipoDaView);

        $divh->addElemento($h);
        $div->addElemento($divh);

        $form1->addElemento($div);

        //$div5->addElemento($this->montaDivMensagens);

        $div6 = new HtmlDiv();
        $div6->setClass("col-md-12");

        $label1 = new HtmlLabel();
        $label1->setFor("fname");
        $label1->setTexto("Nome");

        $input1 = new HtmlInput();
        $input1->setName("usuaNome");
        $input1->setClass("form-control");
        $input1->setPlaceholder("Seu nome completo");
        $input1->setId("fname");
        $input1->setType("text");
        $input1->setValue($usuarioModel->getUsuaNome());
        $div6->addElementos(array($label1, $input1));
        $div5->addElemento($div6);


        $div7 = new HtmlDiv();
        $div7->setClass("row form-group");

        $div8 = new HtmlDiv();
        $div8->setClass("col-md-12");

        $label2 = new HtmlLabel();
        $label2->setFor("cpf");
        $label2->setTexto("CPF");

        $input2 = new HtmlInput();
        $input2->setName("usuaCpf");
        $input2->setClass("form-control");
        $input2->setPlaceholder("Seu CPF");
        $input2->setType("text");
        $input2->setValue($usuarioModel->getUsuaCpf());
       
        $div8->addElementos(array($label2, $input2));
        $div7->addElemento($div8);


        $div9 = new HtmlDiv();
        $div9->setClass("row form-group");


        $div10 = new HtmlDiv();
        $div10->setClass("col-md-12");


        $label3 = new HtmlLabel();
        $label3->setFor("email");
        $label3->setTexto("Email");

        $input3 = new HtmlInput();
        $input3->setName("usuaEmail");
        $input3->setClass("form-control");
        $input3->setPlaceholder("Seu endereço de e-mail");
        $input3->setType("text");
        $input3->setValue($usuarioModel->getUsuaEmail());
        $div10->addElementos(array($label3, $input3));
        $div9->addElemento($div10);



        $div11 = new HtmlDiv();
        $div11->setClass("row form-group");

        $div12 = new HtmlDiv();
        $div12->setClass("col-md-12");

        $label4 = new HtmlLabel();
        $label4->setFor("senha");
        $label4->setTexto("Senha");

        $input4 = new HtmlInput();
        $input4->setName("usuaSenha");
        $input4->setClass("form-control");
        $input4->setPlaceholder("Sua senha");
        $input4->setType("text");
        $input4->setValue($usuarioModel->getUsuaSenha());
        $div12->addElementos(array($label4, $input4));
        $div11->addElemento($div12);



        $div14 = new HtmlDiv();
        $div14->setClass("row form-group");

        $div15 = new HtmlDiv();
        $div15->setClass("col-md-6");

        $label6 = new HtmlLabel();
        $label6->setFor("celular");
        $label6->setTexto("Celular");

        $input6 = new HtmlInput();
        $input6->setName("clieFone1");
        $input6->setClass("form-control");
        $input6->setPlaceholder("Seu número de celular");
        $input6->setType("text");
        $input6->setValue($clienteModel->getClieFone1());
        $div15->addElementos(array($label6, $input6));
        $div14->addElemento($div15);

        $div16 = new HtmlDiv();
        $div16->setClass("col-md-6");


        $label7 = new HtmlLabel();
        $label7->setFor("telefone");
        $label7->setTexto("Telefone");

        $input7 = new HtmlInput();
        $input7->setName("clieFone2");
        $input7->setClass("form-control");
        $input7->setPlaceholder("Seu número de telefone");
        $input7->setType("text");
        $input7->setValue($clienteModel->getClieFone2());

        $div16->addElementos(array($label7, $input7));
        $div14->addElemento($div16);

        //endereço

        $div17 = new HtmlDiv();
        $div17->setClass("row form-group");

        $div18 = new HtmlDiv();
        $div18->setClass("col-md-6");

        $label8 = new HtmlLabel();
        $label8->setFor("endereco");
        $label8->setTexto("Endereço");

        $input8 = new HtmlInput();
        $input8->setName("clieEndereco");
        $input8->setClass("form-control");
        $input8->setPlaceholder("Seu endereço residencial");
        $input8->setType("text");
        $input8->setValue($clienteModel->getClieEndereco());
        $div18->addElementos(array($label8, $input8));
        $div17->addElemento($div18);

        $div19 = new HtmlDiv();
        $div19->setClass("col-md-6");


        $label9 = new HtmlLabel();
        $label9->setFor("complemento");
        $label9->setTexto("Complemento");

        $input9 = new HtmlInput();
        $input9->setName("clieComplementoEndereco");
        $input9->setClass("form-control");
        $input9->setPlaceholder("Seu complemento de endereço");
        $input9->setType("text");
        $input9->setValue($clienteModel->getClieComplementoEndereco());

        $div19->addElementos(array($label9, $input9));

        $div17->addElemento($div19);


        //Cidade
        $div20 = new HtmlDiv();
        $div20->setClass("row form-group");

        $div21 = new HtmlDiv();
        $div21->setClass("col-md-12");

        $label10 = new HtmlLabel();
        $label10->setFor("cidade");
        $label10->setTexto("Cidade");

        $input10 = new HtmlInput();
        $input10->setName("clieCidade");
        $input10->setClass("form-control");
        $input10->setPlaceholder("Sua cidade");
        $input10->setValue($clienteModel->getClieCidade());
        $input10->setType("text");

        $div21->addElementos(array($label10, $input10));
        $div20->addElemento($div21);

        //UF

        $div22 = new HtmlDiv();
        $div22->setClass("row form-group");


        $div23 = new HtmlDiv();
        $div23->setClass("col-md-12");

        $label11 = new HtmlLabel();
        $label11->setFor("uf");
        $label11->setTexto("UF");

        $selectUf = new HtmlSelect();
        $selectUf->setName("clieUf");
        $selectUf->setClass("form-control");

        $option = new htmlOption(FALSE, "Selecione uma opção.", true, "-1", "Selecione uma opção...");

        $selectUf->addElemento($option);

        $option = new htmlOption();
        $option->setValue("GO");
        $option->setConteudo("GO");
        if ($clienteModel->getClieUf() === "GO") {
            $option->setSelected(true);
        }
        $selectUf->addElemento($option);

        $option = new htmlOption();
        $option->setValue("MG");
        $option->setConteudo("MG");
        if ($clienteModel->getClieUf() === "MG") {
            $option->setSelected(true);
        }
        $selectUf->addElemento($option);

        $option = new htmlOption();
        $option->setValue("PA");
        $option->setConteudo("PA");
        if ($clienteModel->getClieUf() === "PA") {
            $option->setSelected(true);
        }
        $selectUf->addElemento($option);

        $div23->addElementos(array($label11, $selectUf));
        $div22->addElemento($div23);

        $form1->addElementos(array($div5, $div7, $div9, $div11, $div14, $div17, $div20, $div22));


        $form1->addElemento($this->montaDivDeBotoes());
        $div4->addElemento($form1);
        $div3->addElemento($div4);
        $div2->addElemento($div3);
        $div1->addElemento($div2);
        return $div1;
    }

    public function recebeDadosDaConsulta() {
//
//        $clienteModel = new ClienteModel($_POST["clieCpf"]);
//
//        return $clienteModel;
    }

    public function recebeDadosDaEntrada() {

        $usuarioModel = new UsuarioModel(
                $_POST["usuaCpf"],
                $_POST["usuaNome"],
                $_POST["usuaEmail"],
                $_POST["usuaSenha"]);

        $clienteModel = new ClienteModel(
                $_POST["usuaCpf"],
                $_POST["clieFone1"],
                $_POST["clieFone2"],
                $_POST["clieEndereco"],
                $_POST["clieComplementoEndereco"],
                $_POST["clieCidade"],
                $_POST["clieUf"]
        );

        return array($usuarioModel, $clienteModel);
    }

    private function montaOptionsDosClientes() {
//        $options = array();
//        $option = new htmlOption(FALSE, "Selecione uma opção.", true, "-1", "Selecione uma opção...");
//        $options [] = $option;
//        $clienteModel = new ClienteModel();
//        $clientes = $clienteModel->buscaArrayObjetoComPs();
//        foreach ($clientes as $clienteModel) {
//            $options [] = new htmlOption(FALSE, null, false, $clienteModel->getClieCpf(), $clienteModel->getClieNome());
//        }
//        //var_dump($option);
//        return $options;
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

    protected function montaFieldsetDadosDeEntrada($objeto) {
        
    }

}
