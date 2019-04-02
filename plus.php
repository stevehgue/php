<?php include('header.php');

if (isset($_GET['plus'])){
  $produit = $_GET['plus'];
  $requete = $bdd->prepare("select * from produit where id = ? ");
  $requete->execute(array($produit));

  if ($requete->rowCount() == 1){
    $info = $requete->fetch();
    $_SESSION['panier'][$produit] += 1;
  }
header('Location: panier.php');
}

?>
