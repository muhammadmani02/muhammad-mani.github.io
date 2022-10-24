<?php 
include('smtp/PHPMailerAutoload.php');
echo 'br';
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$subject = $_REQUEST['subject'];
$message = $_REQUEST['message'];

if(empty($name)){
	echo '<span class="text-danger">Enter Name!</span>';
}else if(empty($email)){
	echo '<span class="text-danger">Enter Mail!</span>';
}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	echo '<span class="text-danger">Mail Incorrect!</span>';
}else if (empty($subject)){
	echo '<span class="text-danger">Enter Subject!</span>';
}else if (empty($message)){
	echo '<span class="text-danger">Enter Message!</span>';
}else{	
	$html='<html><body style="padding:50px; background: #202020;"><div class="width:50%;"><h2 style="color:#1BA098; font-family: century-gothic, sans-serif;">From: '.$name.'</h2><h2 style="color:#1BA098; font-family: century-gothic, sans-serif;">Subject: '.$subject.'</h2><h2 style="color:#1BA098; font-family: century-gothic, sans-serif;">Mail: '.$email.'</h2><h3 style="color:#FFF;">'.$message.'</h3></div></body></html>';
	echo smtp_mailer('moniabdullah7@gmail.com',$subject,$html);
}

function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	//$mail->SMTPDebug  = 3;
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "moniabdullah7@gmail.com";
	$mail->Password = "pnlmxewhfxltfwoj";
	$mail->SetFrom("moniabdullah7@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return '<span class="text-success">Success!</span>';
	}
}


?>