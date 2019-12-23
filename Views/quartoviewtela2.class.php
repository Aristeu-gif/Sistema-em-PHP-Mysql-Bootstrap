<?php

require_once '../Views/quartoview.class.php';

class QuartoViewTela2 extends QuartoView {

    public function montaDivDeBotoes() {
        //div dos botões
        $divDeBotoes = new HtmlDiv();
        $divDeBotoes->setClass("form-group text-center");

        //botão de alteração
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("altera");
        $button->setConteudo("Alterar");
        $button->setClass("btn btn-primary");
        $divDeBotoes->addElemento($button);
        //botão de exclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("exclui");
        $button->setConteudo("Excluir");
        $button->setClass("btn btn-primary");
        $divDeBotoes->addElemento($button);
        //botão de limpeza
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("limpa");
        $button->setConteudo("Limpar");
        $button->setClass("btn btn-primary");
        $divDeBotoes->addElemento($button);

        return $divDeBotoes;
    }

}