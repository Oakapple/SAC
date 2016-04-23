<?php

$secret = '6LcYJh4TAAAAAKftfNnfXzbPD4S6H9jjY_rV6qDc';
$lang = 'en';
?>


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Scottish Arts Club Contact page</title>
    </head>
    <body>
        <h1>Scottish Arts Club contact acknowledgement</h1>
    <?php

$sender_name=stripslashes($_POST["name"]);
$sender_email=stripslashes($_POST["email"]);
$sender_message=stripslashes($_POST["message"]);

$response=$_POST["g-recaptcha-response"];
$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");

$captcha_success=json_decode($verify);
if ($captcha_success->success==false) {
    echo "<p>You are a bot! Go away!</p>";
}
else if ($captcha_success->success==true) {
 

    $email_to = "office@scottishartsclub.co.uk";
 
    $email_subject = "SAC Website Message";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['name']) ||
  
    	!isset($_POST['email']) ||
 
        !isset($_POST['message'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$sender_email)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$sender_name)) {
 
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 
  }
  
  if(strlen($sender_message) < 3) {
 
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Website Query.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "Name: ".clean_string($sender_name)."\n";
  
    $email_message .= "Email: ".clean_string($sender_email)."\n";
  
    $email_message .= "Message: ".clean_string($sender_message)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$sender_email."\r\n".
 
'Reply-To: '.$sender_email."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 
Thank you for contacting us. We will be in touch with you very soon.

<?php
	echo '<p><b>'.$sender_name.'('.$sender_email.')</b><br>'.$sender_message.'</p>'
?>

<p>Click <a href='http://www.scottishartsclub.co.uk'> here</a> to return to the main Club page.
 
<?php
 
}
 
?>

</body>
</html>