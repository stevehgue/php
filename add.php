<?php include('header.php');

if(isset($_POST['submit'])) {
  if(isset($_POST['nom']) AND !empty($_POST['nom']) AND isset($_POST['prix']) AND !empty($_POST['prix']) AND isset($_FILES['myimage'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prix = $_POST['prix'];
    $image = $_FILES["myimage"];
    $imagename = "Images/" . $image["name"];

    $target_dir = "Images/";
    $target_file = $target_dir . basename($image["name"]);

    move_uploaded_file($image["tmp_name"], $target_file);


    $insert_image = $bdd->prepare("insert into produit(nom, prix, photo) values(?,?,?)");
    $insert_image->execute(array($nom, $prix, $imagename));

  } else {
    echo "les valeures sont vides";
  }
}

?>



<form action = "" method = "POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputPassword1">Nom bonbon</label>
    <input type="text" class="form-control" id="nom_bonbon" placeholder="Entrez le nom bonbon" name = "nom">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Prix</label>
    <input type="text" class="form-control" id="prix" placeholder="Entrez le prix du bonbon" name = "prix">
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">image bonbon</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name = "myimage">
  </div>
  <button type="submit" class="btn btn-primary" name = "submit">Submit</button>
</form>

<?php include('footer.php'); ?>
