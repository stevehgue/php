<?php

include('header.php');

 ?>
<?php

if (isset($_POST['bonbon'])){
    $choix = $_POST['bonbon'];
    $search = "select * from produit where nom like '%".$_POST['bonbon']."%'";
    $searchResult = $bdd->query($search);
    while ($produit = $searchResult->fetch(PDO::FETCH_OBJ)){
      ?>
      <div class="card" style="width: 18rem;">
        <img class="card-img-top"  src='<?= $produit->photo?>' alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><?= $produit->nom ?></h5>
          <p class="card-text"><?= $produit->prix ?></p>
        </div>
      </div>
<?php
    }
  }
  include('footer.php');
?>
