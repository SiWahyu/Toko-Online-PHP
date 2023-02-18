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
  <h2>Halaman Kategori</h2>

  <div class="my-3 col-12 col-md-6 mt-5">
    <h4>Tambah Kategori</h4>
    <form action="" method="post">
      <label class="fs-5">Kategori</label>
      <input type="text" name="kategori" placeholder="tambah kategori" class="form-control" required>
      <button class="btn btn-primary mt-2" name="simpan">simpan</button>
    </form>
    
      <?php if(isset($_POST['simpan'])) { ?>
        <?php 
        $kategori = htmlspecialchars($_POST['kategori']);
        $cekQuery = "SELECT nama FROM kategori WHERE nama='$kategori'";
        $resultCek = mysqli_query($connection,$cekQuery);

        if(!$cekData = mysqli_fetch_array($resultCek)) {
          $queryTambahKategori = "INSERT INTO kategori (nama) VALUES ('$kategori')";
          $resultTambahKategori = mysqli_query($connection,$queryTambahKategori);
          echo"
          <div class='alert alert-success mt-2' role='alert'>
          Berhasil menambah kategori
          </div>
          ";
          header('refresh:2');
        }else {
          echo "
          <div class='alert alert-danger mt-2' role='alert'>
          Kategori sudah ada
          </div>
          ";
          header('refresh:2');
        }
        
        ?>
        <?php } ?>
  </div>
  <div class="mt-5">
    <h4>Kategori Produk</h4>
  <?php   if($jumlahKategori > 0) { ?>
  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Nomor</th>
      <th scope="col">Nama</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while($data = mysqli_fetch_array($result)) { ?>
    <tr>
      <th scope="row"><?= $nomor++; ?></th>
      <td><?= $data['nama'] ?></td>
      <td>
        <a class="btn btn-warning text-white" href="kategori_edit.php?id=<?= $data['id']?>">edit</a>
      </td>
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