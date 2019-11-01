<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "nathaliamornelas@gmail.com";
    $email_subject = "Nós ligamos para você";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['nome']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telefone']) ||
        !isset($_POST['horario']) ||
        !isset($_POST['mensagem'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['nome']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telefone']; // not required
    $clock = $_POST['horario']; // not required
    $comments = $_POST['mensagem']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'O endereço de email que preencheu não parece válido.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'O nome que preencheu não parece válido.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'A mensagem que preencheu não parece válido.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalhes da mensagem abaixo.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nome: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telefone: ".clean_string($telephone)."\n";
    $email_message .= "Horario: ".clean_string($clock)."\n";
    $email_message .= "Mensagem: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
echo "<script>alert("Obrigado! Em breve entraremos em contato");window.location.assign('http://www.otimizajr.com.br/');</script>";
 
<?php
 
}
?>