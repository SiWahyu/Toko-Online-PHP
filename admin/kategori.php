<?php 

require_once(__DIR__."/../koneksi.php");

$query = "SELECT * FROM kategori";

$result = mysqli_query($connection,$query);
$jumlahKategori = mysqli_num_rows($result);

$nomor = 1;

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kategori</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
  <?php require_once(__DIR__."/../layouts/navbar.php")?>
  <div class="container mt-5">
  <h2>Kategori</h2>

  <div class="mt-3">
  <?php   if($jumlahKategori > 0) { ?>
  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Nomor</th>
      <th scope="col">Nama</th>
    </tr>
  </thead>
  <tbody>
    <?php while($rows = mysqli_fetch_array($result)) { ?>
    <tr>
      <th scope="row"><?= $nomor++; ?></th>
      <td><?= $rows['nama'] ?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
<?php } else{ ?>
      <h4>Data Kategori Kosong</h4>
    <?php }?>
  </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>