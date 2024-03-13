<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'test1';

$conn = mysqli_connect($servername, $username,$password,$database);

if(!$conn)
{
    die('connection failled:'.mysqli_connect_error());
}

function sanitize_input($data){

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$fullName  = sanitize_input($_POST['fullName']);
$phoneNumber = sanitize_input($_POST['phone']);
$email = sanitize_input($_POST['email']);
$subject = sanitize_input($_POST['subject']);
$message = sanitize_input($_POST['message']);

if(strlen($fullName)>30 || strlen($phoneNumber) > 10 || strlen($email)>30  || strlen($subject) >50 || strlen($message)>300 ){
    die("Error: Character limit please input valid length");
}
 
$sql  = "INSERT INTO users (full_name , phone , email , subject , message) VALUES  ('$fullName' , '$phoneNumber', '$email', '$subject', '$message')";


if(mysqli_query($conn, $sql)){
    echo "form data succesfully save" ;
  }else{
 echo "data not insert ";
  }

  $to = "test@techsolvitservice.com";
  $subject = "Any subject";
  $headers = "Form: $email";
  mail($to, $subject, $message,$headers);
?>