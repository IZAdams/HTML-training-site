<?php

//GEBRUIK OP EIGEN RISICO, ENKEL VOOR TEST DOELEINDEN. DIT SCRIPT BIEDT GEEN BESCHERMING TEGEN SPAM!!!

// er moet een veld met de naam 'email' zijn, en een hidden field met de naam 'ontvanger'

$ontvanger = $_POST['ontvanger'];
$email = $_POST['email'];

if(!$_POST['onderwerp']) {
	//geef hier aan wat de bezoeker ziet na het versturen van de mail
	$onderwerp = "bericht vanaf het contactformulier";
}else{
	$successMsg = $_POST['onderwerp'];
}


if(!$_POST['successMsg']) {
	//geef hier aan wat de bezoeker ziet na het versturen van de mail
	$successMsg = "Bedankt, het bericht is verstuurd...";
}else{
	$successMsg = $_POST['successMsg'];
}

// Attempt to defend against header injections:
$badStrings = array("Content-Type:",
                     "MIME-Version:",
                     "Content-Transfer-Encoding:",
                     "bcc:",
                     "cc:",
					 "<",
					 ">",
					 "[",
					 "]",);

foreach($_POST as $k => $v){
   foreach($badStrings as $v2){
       if(strpos($v, $v2) !== false){
          echo "code of tekens gebruikt die niet toegestaan zijn";
          exit;
       }
   }
}    




foreach($_POST as $key => $i) {
	$stuurbericht .= $key ."= ".$i."<br>";
}

$stuurbericht = stripslashes("$stuurbericht");
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";





$headers .= "From: $email <$email>";
	mail($ontvanger,$onderwerp, $stuurbericht, $headers);
	
	header('Location:bedankt.html');
	echo $successMsg;
	



?>
