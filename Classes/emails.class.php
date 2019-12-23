<?php

/**
 * Este é um Código da Fábrica de Software
 *
 * Coordenador: Elymar Pereira Cabral
 *
 * @date 11/09/2015
 *
 * Descrição de EMails:
 * Esta classe tem por objetivo atender genericamente todas as necessidades relacionadas
 * a emails como, por exemplo, enviar um email para determinada pessoa.
 * 
 * Nem todas as funcionalidades estarão implementadas desde o início, a intenção
 * é complementá-las a medida que se necessitar.
 * 
 * Deve-se pensar no uso dos métodos sem necessidade de instancear a classe.
 * 
 *
 * @author Cayo Eduardo <cayoesn@gmail.com>
 */
class Emails extends PHPMailer {

    private $rodapeAutomatico = true;
    private $naoResponda      = true;

    function __construct($CorpoDoEmailNoFormatoHtml = true) {
        $this->SMTPSecure = 'ssl';
        $this->CharSet    = 'utf-8';
        $this->IsSMTP(); // Define que será enviado por SMTP
        $this->Host       = "smtp.gmail.com"; // Servidor SMTP
        $this->Port       = 465;
        $this->SMTPAuth   = true; // Caso o servidor SMTP precise de autenticação
        $this->Username   = "fsw.artefato@gmail.com"; // Usuário ou E-mail para autenticação no SMTP
        $this->Password   = "@c@demic@fsw";// Senha do E-mail //senha anterior: "f@bric@fsw"; 
        $this->IsHTML($CorpoDoEmailNoFormatoHtml); // Enviar como HTML
        $this->From       = "fsw.artefato@gmail.com"; // Define o Remetente
        $this->FromName   = "FSW"; // Nome do Remetente
    }

    function enviaEmails(Array $enderecos, $assunto, $corpo) {
        foreach ($enderecos as $endereco) {
            parent::AddAddress($endereco['eMail'], $endereco['nome']);
        }

        $this->Subject = 'Aviso FSW - ' . $assunto; // Define o Assunto
        $this->Body    = $corpo;                

        if ($this->rodapeAutomatico) {
            $this->Body .= '<br>--<br>E-mail enviado automaticamente pela <b>Plataforma CAIS da F&aacute;brica de Software do Instituto Federal de Goi&aacute;s</b>.';
        }

        if ($this->naoResponda) {
            $this->Body .= '<br>N&atilde;o responda este e-mail.';
        }

        try {
            $enviou = parent::Send();
        } catch (phpmailerException $e) {
            throw $e;
        }

        return $enviou;
    }

    function adicionaBccs(Array $enderecosENomes) {
        foreach ($enderecosENomes as $enderecoENome) {
            parent::AddBCC($enderecoENome['eMail'], $enderecoENome['nome']);
        }
    }
    
    function setRodapeAutomatico($rodapeAutomatico) {
        $this->rodapeAutomatico = $rodapeAutomatico;
    }

    function setNaoResponda($naoResponda) {
        $this->naoResponda = $naoResponda;
    }

}
