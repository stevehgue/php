<?php
include('header.php');
if (isset($_GET['choix'])){
  $choix = intval($_GET['choix']);
  unset($_SESSION['panier'][$choix]);
  if(count($_SESSION['panier']) == 0) {
    session_destroy();
  }
  header("Location: panier.php");
}

 ?>
