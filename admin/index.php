<?php 

require_once(__DIR__.'/session.php');
require_once(__DIR__.'/../koneksi.php');

$queryKategori = 'SELECT * FROM kategori';
$resultKategori = mysqli_query($connection,$queryKategori);
$jumlahKategori = mysqli_num_rows($resultKategori);

$queryProduk = 'SELECT * FROM produks';
$resultProduk = mysqli_query($connection,$queryProduk);
$jumlahProduk = mysqli_num_rows($resultProduk); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
  <?php require_once(__DIR__."/../layouts/navbar.php"); ?>
  <div class="container">
  <h1>Hii <?= $_SESSION['username'] ?></h1>
  <div class="container mt-5 text-center">
  <div class="row">
    <div class="col-lg-4">
    <div class="card text-bg-secondary" style="width: 18rem;">
  <h3 class="card-header">Kategori</h3>
  <div class="card-body">
    <p class="fs-4 card-text"><?= $jumlahKategori; ?> Kategori</p>
    <p class="fs-4 card-text"><a href="kategori.php" class="btn btn-primary">Lihat Detail</a></p>
  </div>
  </div>
  </div>
    <div class="col-lg-4">
    <div class="card text-bg-success" style="width: 18rem;">
  <h3 class="card-header">Produk</h3>
  <div class="card-body">
    <p class="fs-4 card-text"><?= $jumlahProduk; ?> Produk</p>
    <p class="fs-4 card-text"><a href="produk.php" class="btn btn-primary">Lihat Detail</a></p>
  </div>
  </div>
  </div>
  </div>
  </div>

  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>