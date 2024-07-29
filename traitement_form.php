<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset($_POST["submit"])) {
    $date = $_POST['date1'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $motif = $_POST["obj"];
    $message = $_POST['message'];
    $errors = array();
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      echo "This cleaned email address is considered valid.";
    }else{
      $errors['email'] = "This cleaned email address is not valid. Sorry. xoxo.";
    }
    if (count($errors) > 0) {
      echo "There are mistakes in your form! ";
      print_r($errors);
      exit;
    }

    try{
      $servername = 'localhost';
      $username = 'root';
      $password = '';
      $dbname = 'db_tavola';
      //On établit la connexion
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sth = $conn->prepare("INSERT INTO users (date1, firstname, lastname, email, motif,
      message) VALUES(:date1,:firstname,:lastname, :email, :motif, :message)");
      $sth->bindParam(':date1',$date);
      $sth->bindParam(':firstname',$firstname);
      $sth->bindParam(':lastname',$lastname);
      $sth->bindParam(':email',$email);
      $sth->bindParam(':motif',$motif);
      $sth->bindParam(':message',$message);
      $sth->execute();
      header("Location: contact.php");
      exit();
      }catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
  }
}