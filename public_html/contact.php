<?php

//get data from form  
$name = $_REQUEST['Name'];
$contact= $_REQUEST['Contact'];
$email= $_REQUEST['Email'];
$service= $_REQUEST['Service'];
$message= $_REQUEST['Message'];

$txt ="Name : ". $name . "\r\nEmail : " . $email . "\r\nContact :" . $contact . "\r\nService :" . $service . "\r\nMessage :" . $message;

if(empty($name) || empty($contact) || empty($email) || empty($service) || empty($message)){
    echo "Please fill all fields";
}
else{
  mail("safepowerelectricals9@gmail.com","New form submission from Safepower Electricals.",$txt, "From: $email");

  header('Location:thankyou.html');

}
?>  


