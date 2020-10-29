<?php
// Criar conexão com banco de dados.
$db = mysqli_connect("localhost", "root", "", "image_upload");

// SE o botão upload for clicado.
if (isset($_POST['upload'])) {

  // obter o nome do arquivo.
  $image = $_FILES['image']['name'];

  // Obter a descrição.
  $image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  // diretório dos arquivos.
  $target = "images/" . basename($image);

  $sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";

  mysqli_query($db, $sql);
}
$result = mysqli_query($db, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset UTF-8>
  <link rel="stylesheet" href="bootstrap-4.5.3-dist/bootstrap-4.5.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="styles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    img {
      height: 100px;
    }
  </style>

</head>

<body style="background-image:url(images/animus.jpg)">
  <nav class="navbar navbar-dark bg-dark nav justify-content-center">
    <a class="navbar-brand " href="#">HOME</a>
  </nav>
  <div class="d-flex justify-content-center" style="margin-left:auto; margin-right:auto; width:40%; 
  margin-top:10%; clear:both">
    <form method="POST" action="index.php" enctype="multipart/form-data">
      <input type="hidden" name="size" value="1000000">
      <div>
        <input type="file" name="image" accept="image/*,video/*">
      </div>
      <div>
        <textarea id="text" cols="40" rows="10" name="image_text" placeholder="Descrição" required></textarea>
      </div>
      <div>
        <button class="btn btn-secondary btn-lg" type="submit" name="upload">UPLOAD</button>
      </div>
    </form>
    <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      echo "<img src='images/" . $row['image'] . "'>";
      echo "<p>" . $row['image_text'] . "</p>";
      echo "</div>";
    }
    ?>
  </div>
  <div style="position:fixed; bottom:0; left:0; background-color:grey; width:100%; height:5% ">
    <h4>Autor: Duany Rocker</h4>
  </div>

  <script src="./node_modules/jquery/dist/jquery.js"></script>
  <script src="./node_modules/popper.js/dist/umd/popper.js"></script>
  <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>