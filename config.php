<?php
session_start();
define("HOTE", 'localhost');
define("BDD", 'bonbons');
define("UTILISATEUR", 'root');
define("MDP", '');

  try{
    $bdd  = new PDO('mysql:host ='.HOTE.';dbname='.BDD, UTILISATEUR, MDP, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
  }
  catch(PDOException $e){
    echo "problème de connexion à la BDD <br>".$e->getMessage();
  }

?>
