<?php

require_once 'PHPMailer/class.phpmailer.php';

class MailSender {

    private $destino;
    private $assunto;
    private $mensagem;

    public function __construct() {
        $this->destino = "";
        $this->assunto = "";
        $this->mensagem = "";
    }

    public function setDestino($destino) {
        $this->destino = $destino;
    }

    public function setAssunto($assunto) {
        $this->assunto = $assunto;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function enviarMensagem() {

        $this->mensagem .= "<br><br><strong>(Esta é uma mensagem automática, não é necessário respondê-la)</strong>";
        
        $mail = new PHPMailer();

        $mail->Mailer = "smtp";
        $mail->IsHTML(true);
        $mail->CharSet = "utf-8";
        $mail->SMTPSecure = "tls";
        $mail->Host = "mail.eventoslife.com.br";
        $mail->Port = "587";
        $mail->SMTPAuth = "true";
        $mail->Username = "triagem@eventoslife.com.br";
        $mail->Password = "8T2cuzRW";
        $mail->From = "triagem@eventoslife.com.br";
        $mail->FromName = "Life";
        $mail->AddAddress($this->destino);
        $mail->Subject = $this->assunto;
        $mail->Body = $this->mensagem;

        return $mail->Send();
    }
}

?>
