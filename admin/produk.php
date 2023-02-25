<?php

require_once(__DIR__.'/session.php');
require_once(__DIR__.'/../koneksi.php');

$result = mysqli_query($connection,"SELECT * FROM produks");
$resultKategori = mysqli_query($connection,"SELECT * FROM kategori");

$rows = mysqli_num_rows($result);


$nomor = 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php 
require_once(__DIR__.'/../layouts/navbar.php');
?>
  <div class="container">
    <div class="mt-5">
      <h2>Halaman Produk</h2>
        <div class="my-3 col-12 col-md-6 mt-5">
         <h4>Tambah Produk</h4>
            <form enctype="multipart/form-data" action="" method="post">
              <label class="fs-5">Nama</label>
              <input type="text" name="nama" placeholder="tambah produk" class="form-control" required autocomplete="off" value="">
              <label class="fs-5">Kategori</label>
              <select name="kategori" class="form-select">
                <option value="">Pilih</option>
                <?php while($dataKategori = mysqli_fetch_array($resultKategori)){ ?>
                <option value="<?= $dataKategori['id']?>"><?= $dataKategori['nama'] ?></option>
                <?php } ?>
              </select>
              <label class="fs-5">Harga</label>
              <input type="number" name="harga" class="form-control" required autocomplete="off">
              <label class="fs-5">Foto</label>
              <input type="file" name="foto" class="form-control" required>
              <?php 
              
              if(isset($_POST['simpan'])){

                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersedian_stok = htmlspecialchars($_POST['ketersedian_stok']);
              
                $target_dir = __DIR__."/../image/";
                $fileName = basename($_FILES['foto']['name']);
                $target_file = $target_dir . $fileName;
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                $fileSize = $_FILES['foto']['size'];
                $uniqFileName = uniqid().".".$fileType;

                //cek size dan type file gambar yang di upload
                if($fileSize >= 1000000){
                  echo "
                  <div class='alert alert-danger mt-2' role='alert'>
                  Gambar yang di upload tidak boleh lebih dari 1MB
                  </div>
                  ";
                } else {
                  if($fileType != 'jpg' && !$fileType != 'png' && $fileType != 'jpeg'){
                    echo "
                    <div class='alert alert-danger mt-2' role='alert'>
                    Gambar yang di upload harus berformat jpg,png atau jpeg
                    </div>
                    ";
                  } else {
                    //kalau berhasil
                    $query = "INSERT INTO produks (kategori_id,nama,harga,foto,detail,ketersedian_stok) VALUES ('$kategori','$nama','$harga','$uniqFileName','$detail','$ketersedian_stok')";

                    $result = mysqli_query($connection,$query);

                    move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir.$uniqFileName);
                    echo "
                    <div class='alert alert-danger mt-2' role='alert'>
                    Berhasil Menambah Produk
                    </div>
                    ";

                    header('refresh:2');
                  }
                }
                
              }
              ?>
              <label class="fs-5">Detail</label>
              <textarea name="detail" id="" class="form-control" cols="20" rows="5" required></textarea>
              <label class="fs-5">ketersedian Stok</label>
              <select name="ketersedian_stok" class="form-select">
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
              </select>
              <button class="btn btn-primary mt-2" name="simpan">simpan</button>
            </form>
        </div>
    </div>
    <div class="mt-5">
            <?php if(!$rows > 0) { ?>
              <h4>Data Produk Kosong</h4>
            <?php }else { ?>
              <h4>Kategori Produk</h4>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Ketersedian Stok</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($data = mysqli_fetch_array($result)) { ?>
                    <tr>
                  <td><?= $nomor++ ?></td>
                  <td><?= $data['nama'] ?></td>
                  <td><?= $data['kategori_id'] ?></td>
                  <td><?= $data['harga'] ?></td>
                  <td><?= $data['ketersedian_stok'] ?></td>
                  <td>
                    <a class="btn btn-warning" href="produk_edit.php?id=<?=$data['id']?>">edit</a>
                    <a class="btn btn-danger text-white" href="produk_delete.php?<?=$data['id']?>">delete</a>
                  </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
  <?php } ?>
</div>
  </div>
</body>
</html>