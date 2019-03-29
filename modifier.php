<?php

include('header.php');

if(isset($_POST['submit'])){
  if(isset($_POST['nom']) AND !empty($_POST['nom']) AND isset($_POST['prix']) AND !empty(['prix']) AND isset($_FILES['myimage']) AND isset($_GET['choix'])){
    $nom = htmlspecialchars($_POST['nom']);
    $prix = intval($_POST['prix']);
    $image = $_FILES["myimage"];
    $imagename = "Images/" . $image["name"];
    $modif = $_GET['choix'];

    $modifier_bonbon = $bdd->prepare("update produit set nom = ?, prix = ?, photo = ? where id = ?");
    $modifier_bonbon->execute(array($nom, $prix, $imagename, $modif));

    header('Location: test.php');
  }
}


 ?>


 <form action = "" method = "POST" enctype="multipart/form-data">
   <div class="form-group">
     <label for="exampleInputPassword1">Nom bonbon</label>
     <input type="text" class="form-control" id="nom_bonbon" placeholder="Entrez le nouveau nom du bonbon" name = "nom">
   </div>
   <div class="form-group">
     <label for="exampleInputPassword1">Prix</label>
     <input type="text" class="form-control" id="prix" placeholder="Entrez le nouveau prix du bonbon" name = "prix">
   </div>
   <div class="form-group">
     <label for="exampleFormControlFile1">image bonbon</label>
     <input type="file" class="form-control-file" id="exampleFormControlFile1" name = "myimage">
   </div>
   <button type="submit" class="btn btn-primary" name = "submit">Submit</button>
 </form>

 <?php include('footer.php'); ?>
