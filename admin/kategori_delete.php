<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php 
require_once(__DIR__.'/../koneksi.php');
require_once(__DIR__.'/session.php');

$id = $_GET['id'];

$queryCek = "SELECT * FROM produks WHERE kategori_id='$id'";
$resultCek = mysqli_query($connection,$queryCek);

$jumlahBaris = mysqli_num_rows($resultCek);

if($jumlahBaris > 0){
  echo "
  <div class='container'>
  <div class='alert alert-warning mt-2' role='alert'>
  Kategori sudah digunakan oleh produk
  </div>
  </div>
  ";
} else {
  
  $query = "DELETE FROM kategori WHERE id='$id'";
  $result = mysqli_query($connection,$query);

  echo "
  <div class='container'>
  <div class='alert alert-success mt-2' role='alert'>
  Berhasil menghapus kategori
  </div>
  </div>
  <script>
  setInterval(()=> {
    window.location.href = 'kategori.php';
  },2000)
  </script>";
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>