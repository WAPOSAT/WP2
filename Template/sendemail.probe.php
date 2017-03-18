<?php

//Hola mundo de internet, aca intentare hacer magia con esta linea
// Esta linea es de vista

$mail_To="juan.initec@gmail.com";
$headers = "";
$headers .= "From: juan.basflo@gmail.com\n";
$headers .= "Reply-To: jotabeles.web@gmail.com\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$headers .= "X-Mailer: php";
$mail_Subject = " Live TV key";
$mail_Body = "<p>Muscle-tube</p>";

if(mail($mail_To, $mail_Subject, $mail_Body,$headers)){
	echo "OK";
} else {
	echo "No OK";
}
?> 