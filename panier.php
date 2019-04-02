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

if(isset($_SESSION['panier'])) {

  foreach($_SESSION['panier'] as $produit=>$quantite){
    $requete = $bdd->prepare("SELECT * FROM produit where id = ?");
    $requete->execute(array($produit));

    if ($requete->rowCount() == 1){
      $info = $requete->fetch();
      $panier[$info['id']] = [];
      $panier[$info['id']]['id'] = $info["id"];
      $panier[$info['id']]["nom"] = $info["nom"];
      $panier[$info['id']]["prix"] = $info["prix"];
      $panier[$info['id']]["photo"] = $info["photo"];
      $panier[$info['id']]["quantite"] = $quantite;
    }
  }
}
  ?>
<div class="container">
  <div class="row"><?php
if(isset($_SESSION['panier']) and isset($panier)) {
 foreach($panier as $produit){?>
   <div class="col-sm-3">
    <div class="card">
      <img class="card-img-top"  src='<?= $produit["photo"]?>' alt="Card image cap" style="height:200px;">
      <div class="card-body">
        <h5 class="card-title">Nom: <?= $produit["nom"] ?></h5>
        <p class="card-text">Prix: <?= $produit["prix"] ?> €</p>
        <p class= "card-text">quantite: <?= $produit["quantite"] ?></p>
        <a href = "destroy_product.php?choix=<?= $produit["id"]?>"><button type="button" class="btn btn-outline-danger">Supprimer</button></a>
        <a href = "plus.php?plus=<?= $produit["id"]?>"><button type="button" class="btn btn-primary">+1</button></a>
        <a href = "moins.php?moins=<?= $produit["id"]?>"><button type="button" class="btn btn-primary">-1</button></a>
    </div>
  </div>
</div>

  <?php }
  ?>
  <?php
 ?>
</div>
</div>
<?php
if (isset($_SESSION['panier']) and count($_SESSION['panier']) > 0) {?>
  <a href="destroy.php"><button type="button" class="btn btn-secondary btn-lg">Supprimer panier</button></a>
<?php }
?>
<div class="alert alert-primary" role="alert">
<?php  $total = 0;
  foreach($panier as $produit){
    $total += $produit["prix"] * $produit["quantite"];
  }
  echo "<strong>Total hors taxe</strong>".":" . $total . "€</br>";
  $fdp = 5;
  $tva = $total * 19.6 / 100;
  echo "<strong>TVA</strong>".":" . $tva . "</br>";
  $total += $tva + $fdp;
  echo "<strong>Total TTC</strong>" . ":" .  $total ."€";
}?>
</div>
<?php
include('footer.php');
?>
