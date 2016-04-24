<?php


require("PHPMailer-master/class.phpmailer.php");

Class Correo
{
  var $titulo,$from,$fromtxt,$to,$totxt,$asunto;
  function Correo()
  {}
  
  function enviar($txt)
  {
    global $html;
    $mail = new PHPMailer();

    $mail->CharSet = "UTF-8";
    if ($this->fromtxt)
      $mail->SetFrom($this->from,$this->fromtxt);
    else
      $mail->SetFrom($this->from);
    $mail->Subject = $this->titulo;
    $mail->IsHTML(true);
    $html->assign("asunto",$this->asunto);

    $html->assign("txt",$txt);



    $mail->MsgHTML(mostrartpl("email.tpl",true));
    if ($this->totxt)   
      $mail->AddAddress($this->to,$this->totxt);
    else
      $mail->AddAddress($this->to);

    $mail->Send();
  }
}
