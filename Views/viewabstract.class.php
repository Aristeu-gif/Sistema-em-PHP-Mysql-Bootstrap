<?php

require_once '../ComponentesHtml/htmlhtml.class.php';
require_once '../ComponentesHtml/htmlhead.class.php';
require_once '../ComponentesHtml/htmllink.class.php';
require_once '../ComponentesHtml/htmlbody.class.php';
require_once '../ComponentesHtml/htmldiv.class.php';
require_once '../ComponentesHtml/htmlp.class.php';
require_once '../ComponentesHtml/htmltitle.class.php';
require_once '../ComponentesHtml/htmlfieldset.class.php';
require_once '../ComponentesHtml/htmllegend.class.php';
require_once '../ComponentesHtml/htmlstyle.class.php';
require_once '../ComponentesHtml/htmllink.class.php';
require_once '../ComponentesHtml/htmlmeta.class.php';
require_once '../ComponentesHtml/htmlscript.class.php';
require_once '../ComponentesHtml/htmlnoscript.class.php';
require_once '../ComponentesHtml/htmlbody.class.php';
require_once '../ComponentesHtml/htmlp.class.php';
require_once '../ComponentesHtml/htmlbr.class.php';
require_once '../ComponentesHtml/htmldiv.class.php';
require_once '../ComponentesHtml/htmlform.class.php';
require_once '../ComponentesHtml/htmlinput.class.php';
require_once '../ComponentesHtml/htmllabel.class.php';
require_once '../ComponentesHtml/htmltextarea.class.php';
require_once '../ComponentesHtml/htmloption.class.php';
require_once '../ComponentesHtml/htmlbutton.class.php';
require_once '../ComponentesHtml/htmlselect.class.php';
require_once '../ComponentesHtml/htmlTd.class.php';
require_once '../ComponentesHtml/htmlTh.class.php';
require_once '../ComponentesHtml/htmlTr.class.php';
require_once '../ComponentesHtml/htmlnav.class.php';
require_once '../ComponentesHtml/htmlA.class.php';
require_once '../ComponentesHtml/htmlh.class.php';
require_once '../ComponentesHtml/htmlImg.class.php';
require_once '../ComponentesHtml/htmlcenter.class.php';
require_once '../ComponentesHtml/htmlUl.class.php';
require_once '../ComponentesHtml/htmlli.class.php';
require_once '../ComponentesHtml/htmlaside.class.php';
require_once '../ComponentesHtml/htmlfooter.class.php';
require_once '../ComponentesHtml/htmli.class.php';
require_once '../ComponentesHtml/htmlsmall.class.php';
require_once '../ComponentesHtml/htmlstrong.class.php';

abstract class ViewAbstract {

    protected $bt;
    protected $mensagens;
    protected $title;
    protected $html;
    protected $htmlHead;
    protected $htmlBody;

    public function __construct($titulo) {
        $this->bt = null;
        $this->mensagens = array();
        $this->title = new HtmlTitle($titulo);
    }

    public function displayInterface($objeto1 = null, $objeto2 = null, $tituloDaPagina = null) {
        $this->montaHmtl($objeto1, $objeto2, $tituloDaPagina);
        echo $this->html->geraHtml();
    }

    protected function montaHmtl($objeto, $objeto2 = null, $tituloDaPagina = null) {
        $this->html = new HtmlHtml();
        $this->html->setHead($this->montaHead());
        $this->html->setBody($this->montaBody($objeto, $objeto2, $tituloDaPagina));
    }

    function montaNavBar() {
        $nav = new HtmlNav();
        $nav->setClass("colorlib-nav");
        $nav->setRole("navigation");

        $div1 = new HtmlDiv();
        $div1->setClass("top-menu");


        $div2 = new HtmlDiv();
        $div2->setClass("container");


        $div3 = new HtmlDiv();
        $div3->setClass("row");

        $div4 = new HtmlDiv();
        $div4->setClass("col-xs-2");

        $div5 = new HtmlDiv();
        $div5->setId("colorlib-logo");

        $hLogo = new HtmlH();
        $hLogo->setTipo("2");
        $hLogo->setTexto("Minha Pousada");

        $div5->addElemento($hLogo);
        $div4->addElemento($div5);

        //ok

        $div6 = new HtmlDiv();
        $div6->setClass("col-xs-10 text-right menu-1");

        $ul = new HtmlUl();

        $li1 = new HtmlLi();

        $a1 = new htmlA();

        $a1->setTexto("Área do Cliente");
        $a1->setHref("cliente.php");


        $li1->addElemento($a1);
        $ul->addElemento($li1);

        //ok

        $li2 = new HtmlLi();
        $li2->setClass("has-dropdown");

        $a2 = new htmlA();
        $a2->setHref("rooms-suites.html");
        $a2->setTexto("Administrador");
        $a2->setHref("administrador.php");
        $li2->addElemento($a2);

        //ok


        $ul->addElemento($li2);
        $div6->addElemento($ul);

        //ok

        $li7 = new HtmlLi();
        $a7 = new htmlA();
        $a7->setHref("dining-bar.html");
        $a7->setTexto("Reserva");
        $a7->setHref("reserva.php");
        $li7->addElemento($a7);

        $li8 = new HtmlLi();
        $a8 = new htmlA();
        $a8->setHref("login.php");
        $a8->setTexto("Login |  Sair");
        $li8->addElemento($a8);




        $ul->addElementos(array($li7, $li8));

        $div3->addElemento($div4);
        $div3->addElemento($div6);

        $div2->addElemento($div3);
        $div1->addElemento($div2);

        $nav->addElemento($div1);

        return $nav;
    }

    protected function montaHead() {
        $this->htmlHead = new HtmlHead();

        $this->htmlHead->setTitle($this->title);

        $metaCharset = new HtmlMeta();
        $metaCharset->setCharset("utf-8");
        $this->htmlHead->addMeta($metaCharset);

        $metaHttpEquiv = new HtmlMeta();
        $metaHttpEquiv->setHttpequiv("X-UA-Compatible");
        $metaHttpEquiv->setContent("IE=edge");
        $this->htmlHead->addMeta($metaHttpEquiv);

        $metaNameViewPort = new HtmlMeta();
        $metaNameViewPort->setName("viewport");
        $metaNameViewPort->setContent("width=device-width, initial-scale=1");
        $this->htmlHead->addMeta($metaNameViewPort);

        $metaNameDescription = new HtmlMeta();
        $metaNameDescription->setName("description");
        $this->htmlHead->addMeta($metaNameDescription);

        $metaNameKeywords = new HtmlMeta();
        $metaNameKeywords->setName("keywords");
        $this->htmlHead->addMeta($metaNameKeywords);

        $metaNameAuthor = new HtmlMeta();
        $metaNameAuthor->setName("author");
        $this->htmlHead->addMeta($metaNameAuthor);

        //Facebook e twitter
        //todas variaveis se chamam meta para facilitar a implementação

        $meta = new HtmlMeta();
        $meta->setProperty("og:title");
        $this->htmlHead->addMeta($meta);

        $meta = new HtmlMeta();
        $meta->setProperty("og:image");
        $this->htmlHead->addMeta($meta);

        $meta = new HtmlMeta();
        $meta->setProperty("og:url");
        $this->htmlHead->addMeta($meta);

        $meta = new HtmlMeta();
        $meta->setProperty("og:site_name");
        $this->htmlHead->addMeta($meta);

        $meta = new HtmlMeta();
        $meta->setProperty("og:description");
        $this->htmlHead->addMeta($meta);

        $meta = new HtmlMeta();
        $meta->setProperty("twitter:title");
        $this->htmlHead->addMeta($meta);

        $meta = new HtmlMeta();
        $meta->setProperty("twitter:image");
        $this->htmlHead->addMeta($meta);

        $meta = new HtmlMeta();
        $meta->setProperty("twitter:url");
        $this->htmlHead->addMeta($meta);

        $meta = new HtmlMeta();
        $meta->setProperty("twitter:card");
        $this->htmlHead->addMeta($meta);

        //segue a sequencia de links

        $link = new Htmllink();
        $link->setHref("https://fonts.googleapis.com/css?family=Poppins:300,400,500,700");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("https://fonts.googleapis.com/css?family=Playfair+Display:400,700");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/css/animate.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/css/icomoon.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/css/bootstrap.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/css/magnific-popup.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/css/flexslider.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/css/owl.carousel.min.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/css/owl.theme.default.min.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/css/bootstrap-datepicker.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/fonts/flaticon/font/flaticon.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);

        $link = new Htmllink();
        $link->setHref("/PW-MinhaPousada/css/style.css");
        $link->setRel("stylesheet");
        $this->htmlHead->addLink($link);



        return $this->htmlHead;
    }

    public function montaDivisao() {
        $div1 = new HtmlDiv();
        $div1->setClass("row form-group");

        $div2 = new HtmlDiv();
        $div2->setClass("col-md-6");

        $div1->addElemento($div2);

        $div3 = new HtmlDiv();
        $div3->setClass("row form-group");

        $div4 = new HtmlDiv();
        $div4->setClass("col-md-6");

        $div3->addElemento($div4);

        $div1->addElemento($div3);
        return $div1;
    }

    private function montaIconVoltarAoTopo() {
        $div = new HtmlDiv();
        $div->setClass("gototop js-top");

        $a = new htmlA();
        $a->setHref("#");
        $a->setClass("js-gotop");

        $i = new htmlI();
        $i->setClass("icon-arrow-up2");

        $a->addElemento($i);
        $div->addElemento($a);

        return $div;
    }

    private function montaCarregamentoDosScript() {
        $div = new HtmlDiv();
        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/jquery.min.js");
        $div->addElemento($script);

        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/jquery.easing.1.3.js");
        $div->addElemento($script);

        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/bootstrap.min.js");
        $div->addElemento($script);

        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/jquery.waypoints.min.js");
        $div->addElemento($script);

        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/jquery.flexslider-min.js");
        $div->addElemento($script);

        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/owl.carousel.min.js");
        $div->addElemento($script);

        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/jquery.magnific-popup.min.js");
        $div->addElemento($script);

        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/magnific-popup-options.js");
        $div->addElemento($script);

        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/bootstrap-datepicker.js");
        $div->addElemento($script);

        $script = new HtmlScript();
        $script->setSrc("/PW-MinhaPousada/js/main.js");
        $div->addElemento($script);

        return $div;
    }

    protected function montaBody($objeto, $objeto2 = null, $tituloDaPagina = null) {
        $body = new HtmlBody();
        $body->setClass("body");
        $body->addElemento($this->montaNavBar());

        //$body->addElemento($this->montaAside());
        //$body->addElemento($this->montaDivisao());
        $body->addElemento($this->montaDivMensagens());
        $body->addElemento($this->montaForm($objeto, $objeto2, $tituloDaPagina));
        $body->addElemento($this->montaFooter());

        //$body->addElemento($this->montaIconVoltarAoTopo());
        // $body->addElemento($this->montaCarregamentoDosScript());
        return $body;
    }

    public function comboboxconsultaEButtonConsulta() {
        $div11 = new HtmlDiv();
        $div11->setClass("row form-group");

        $div12 = new HtmlDiv();
        $div12->setClass("col-md-6");

        $label4 = new HtmlLabel();

        $label4->setTexto("Quartos");

        $combo = new HtmlSelect();
        $combo->setName("comboBoxQuarNumero");
        $combo->setClass("form-control");

        $options = $this->montaOptionsDosQuartos();
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

    public function montaDivMensagens() {

        $divTotal = new HtmlDiv();
        $divTotal->setClass("col-md-12");
        foreach ($this->mensagens as $mensagem) {
            $divContainer = new HtmlDiv();
            $divContainer->setClass("container");
            $div = new HtmlDiv();
            $div->setClass("alert alert-info");
            $div->setRole("alert");

            $strong = new htmlStrong();
            $strong->setTextoStrong("Notificação:  ");
            $strong->setTexto($mensagem);
            $div->addElemento($strong);
            $divContainer->addElemento($div);
            $divTotal->addElemento($divContainer);
        }
        return $divTotal;
    }

    public function montaFooter() {


        $footer1 = new htmlFooter();
        $footer1->setId("colorlib-footer");
        $footer1->setRole("contentinfo");

        $div1 = new HtmlDiv();
        $div1->setClass("container");

        $div2 = new HtmlDiv();
        $div2->setClass("row row-pb-md");

        $div3 = new HtmlDiv();
        $div3->setClass("col-md-3 colorlib-widget");

        $h1 = new HtmlH();
        $h1->setTipo("4");
        $h1->setTexto("Minha Pousada");

        $div3->addElemento($h1);

        $p1 = new HtmlP();
        $p1->setTexto("O lugar na qual você descansa na terra, mas a sensação é divina!");

        $div3->addElemento($p1);

        $p2 = new HtmlP();

        $ul1 = new HtmlUl();
        $ul1->setClass("colorlib-social-icons");

        $li1 = new HtmlLi();

        $i1 = new htmlI();
        $i1->setClass("icon-twitter");
        $li1->addElemento($i1);

        $ul1->addElemento($li1);

        $li2Contatos = new HtmlLi();
        $i2 = new htmlI();
        $i2->setClass("icon-facebook");
        $li2Contatos->addElemento($i2);
        $ul1->addElemento($li2Contatos);

        $li3Contatos = new HtmlLi();
        $i3 = new htmlI();
        $i3->setClass("icon-linkedin");
        $li3Contatos->addElemento($i3);
        $ul1->addElemento($li3Contatos);

        $li4Contatos = new HtmlLi();
        $i4 = new htmlI();
        $i4->setClass("icon-dribbble");
        $li4Contatos->addElemento($i4);
        $ul1->addElemento($li4Contatos);

        $p2->addElemento($ul1);
        $div3->addElemento($p2);
        $div2->addElemento($div3);

        //serviços

        $divContatos = new HtmlDiv();
        $divContatos->setClass("col-md-3 colorlib-widget");

        $h2Contatos = new HtmlH();
        $h2Contatos->setTipo("4");
        $h2Contatos->setTexto("Serviços");
        $divContatos->addElemento($h2Contatos);
        $div2->addElemento($divContatos);

        $p3Contatos = new HtmlP();

        $ul2Contatos = new HtmlUl();
        $ul2Contatos->setClass("colorlib-footer-links");

        $li2Contatos = new HtmlLi();
        $li2Contatos->setTexto("Suporte 24h");
        $ul2Contatos->addElemento($li2Contatos);

        $li3Contatos = new HtmlLi();
        $li3Contatos->setTexto("Atendimento");
        $ul2Contatos->addElemento($li3Contatos);

        $li4Contatos = new HtmlLi();
        $li4Contatos->setTexto("Auxiliar de Quarto");
        $ul2Contatos->addElemento($li4Contatos);

        $li5Contatos = new HtmlLi();
        $li5Contatos->setTexto("Garçons 24h");
        $ul2Contatos->addElemento($li5Contatos);

        $p3Contatos->addElemento($ul2Contatos);
        $divContatos->addElemento($p3Contatos);
        //$div2->addElemento($div4);
        //Contatos

        $divContatos = new HtmlDiv();
        $divContatos->setClass("col-md-3 colorlib-widget");

        $h2Contatos = new HtmlH();
        $h2Contatos->setTipo("4");
        $h2Contatos->setTexto("Contatos");
        $divContatos->addElemento($h2Contatos);
        $div2->addElemento($divContatos);

        $p3Contatos = new HtmlP();

        $ul2Contatos = new HtmlUl();
        $ul2Contatos->setClass("colorlib-footer-links");

        $li2Contatos = new HtmlLi();
        $li2Contatos->setTexto("+55 (62) 98423-3038");
        $ul2Contatos->addElemento($li2Contatos);

        $li3Contatos = new HtmlLi();
        $li3Contatos->setTexto("Aristeudias08@gmail.com");
        $ul2Contatos->addElemento($li3Contatos);

        $li4Contatos = new HtmlLi();
        $li4Contatos->setTexto("Suporte.24h@gol.gov");
        $ul2Contatos->addElemento($li4Contatos);

        $li5Contatos = new HtmlLi();
        $li5Contatos->setTexto("Atendimento@Geral.com");
        $ul2Contatos->addElemento($li5Contatos);

        $p3Contatos->addElemento($ul2Contatos);
        $divContatos->addElemento($p3Contatos);



        //postagem recente no blog

        $div5 = new htmldiv();
        $div5->setClass("col-md-3");

        $h3 = new HtmlH();
        $h3->setTipo("4");
        $h3->setTexto("Postagem recente no blog");

        $div5->addElemento($h3);

        $ul3 = new HtmlUl();
        $ul3->setClass("colorlib-footer-links");

        $li9 = new HtmlLi();
        $li9->setTexto("Um dos lugares mais aconchegantes que já conheci");
        $ul3->addElemento($li9);

        $li10 = new HtmlLi();
        $li10->setTexto("Realizei a trilha matinal dos meus sonhos na Minha Pousada");
        $ul3->addElemento($li10);

        $li11 = new HtmlLi();
        $li11->setTexto("A Minha Pousada possui os melhores restaurantes e bares da cidade");
        $ul3->addElemento($li11);

        $div5->addElemento($ul3);

        $div2->addElemento($div5);

        //direitos reservados

        $div6 = new HtmlDiv();
        $div6->setClass("row");

        $div7 = new HtmlDiv();
        $div7->setClass("col-md-12 text-center");

        $p4 = new HtmlP();

        $small = new htmlSmall();
        $small->setClass("block");

        $small->addElemento("Copyright &copy;");

        $script = new HtmlScript();
        $script->setScript("document.write(new Date().getFullYear());");

        $small->addElemento($script);

        $small->addElemento("Todos os direitos reservados | Desenvolvedores: Aristeu Dias Garcia Da Silva; Júlio César; Felipe Marcolino.");

        $p4->addElemento($small);

        $div1->addElemento($div2);

        $div7->addElemento($p4);

        $div6->addElemento($div7);

        $div1->addElemento($div6);

        $footer1->addElemento($div1);

        return $footer1;
    }

    protected function montaDivCabecalho() {
        $nav = new HtmlNav();
        $nav->setClass("navbar navbar-inverse navbar-fixed-top");

        $divContainer = new HtmlDiv();
        $divContainer->setClass("container");

        $divNavBar = new HtmlDiv();
        $divNavBar->setClass("navbar-header");

        $a = new htmlA();
        $a->setClass("navbar-brand");
        $a->setHref("#");
        $a->setTexto("Minha Pousada");

        $divNavBar->addElemento($a);
        $divContainer->addElemento($divNavBar);
        $nav->addElemento($divContainer);
        return $nav;
    }

    abstract public function recebeDadosDaConsulta();

    abstract public function recebeDadosDaEntrada();

    function getBt() {
        if (isset($_POST ['bt'])) {
            return $this->bt = $_POST ['bt'];
        } else {
            return null;
        }
    }

    function setBt($bt) {
        $this->bt = $bt;
    }

    function getMensagens() {
        $mensagens = array();

        foreach ($this->mensagens as $mensagem) {
            $htmlP = new HtmlP();
            $htmlP->setTexto($mensagem);
            $mensagens [] = $htmlP;
        }

        return $mensagens;
    }

    function addMensagem($mensagem) {
        $this->mensagens [] = $mensagem;
    }

    function addMensagens(array $mensagens) {
        foreach ($mensagens as $mensagem) {
            $this->addMensagem($mensagem);
        }
    }

    public function montaDivDeBotoes() {
        //div dos botões
        $divDeBotoes = new HtmlDiv();

        //botão de inclusão
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("inclui");
        $button->setConteudo("Incluir");
        $divDeBotoes->addElemento($button);
        //botão de limpeza
        $button = new HtmlButton();
        $button->setName("bt");
        $button->setType("submit");
        $button->setValue("limpa");
        $button->setConteudo("Limpar");
        $divDeBotoes->addElemento($button);

        return $divDeBotoes;
    }

}
