<?php
include('header.php');
$resultat=$bdd->query("select * from produit");
if(isset($_GET['choix'])) {
  $del = $_GET['choix'];
  $resultat2 = $bdd->prepare("delete from produit where id = ?");
  $resultat2->execute(array($del));

  header('Location: test.php');
}
?>

<div class="container">
  <div class="row">
<?php while ($produit = $resultat->fetch(PDO::FETCH_OBJ)){ ?>
    <div class="col-sm-3">
      <div class="card">
        <img class="card-img-top"  src='<?= $produit->photo?>' alt="Card image cap" style="height:200px;">
        <div class="card-body">
          <h5 class="card-title"><?= $produit->nom ?></h5>
          <p class="card-text"><?= $produit->prix ?></p>
          <a href = "test.php?choix=<?= $produit->id ?>"><button type="button" class="btn btn-primary">Supprimer</button></a>
          <a href = "modifier.php?choix=<?= $produit->id?>"><button type "button" class="btn btn-primary">Modifier</button></a>
          <a href = "panier.php?choix=<?= $produit->id?>"><button type "button" class="btn btn-primary">Ajouter au panier</button></a>
        </div>
      </div>
    </div>
<?php } ?>
  </div>
</div>

<?php include('footer.php'); ?>
