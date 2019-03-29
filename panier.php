<?php include('header.php');
if (isset($_GET['choix'])){
  $choix = intval($_GET['choix']);
}
if(!isset($_SESSION['panier'])){
  $_SESSION['panier'] = array();
} else {
  if (isset($choix)){
    if(isset($_SESSION['panier'][$choix])){
      $_SESSION['panier'][$choix] ++;
    }else {
        $_SESSION['panier'][$choix] = 1;
      }
    }
}

foreach($_SESSION['panier'] as $produit=>$quantite){
  $requete = $bdd->prepare("SELECT * FROM produit where id = ?");
  $requete->execute(array($produit));

  if ($requete->rowCount() == 1){
    $info = $requete->fetch();
    $panier[$info['id']] = [];
    $panier[$info['id']]["nom"] = $info["nom"];
    $panier[$info['id']]["prix"] = $info["prix"];
    $panier[$info['id']]["photo"] = $info["photo"];
    $panier[$info['id']]["quantite"] = $quantite;
  }
}?>
<div class="container">
  <div class="row"><?php
 foreach($panier as $produit){?>
   <div class="col-sm-3">
    <div class="card">
      <img class="card-img-top"  src='<?= $produit["photo"]?>' alt="Card image cap" style="height:200px;">
      <div class="card-body">
        <h5 class="card-title">Nom: <?= $produit["nom"] ?></h5>
        <p class="card-text">Prix: <?= $produit["prix"] ?> €</p>
        <p class= "card-text">quantite: <?= $produit["quantite"] ?></p>
    </div>
  </div>
</div>

  <?php }
  ?>
  <?php
  $total = 0;
  foreach($panier as $produit){
    $total += $produit["prix"] * $produit["quantite"];
  }
  echo "total hors taxe: $total €</br>";
  $fdp = 5;
  $tva = $total * 19.6 / 100;
  echo "TVA: $tva</br>";
  $total += $tva + $fdp;
  echo "total TTC: $total €";
   ?>
</div>
</div>
<?php


include('footer.php');
?>
