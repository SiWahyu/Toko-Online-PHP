<?php 
$id = $_GET['id'];

require_once(__DIR__."/../koneksi.php");

$queryProduk = "SELECT a.*,b.nama AS nama_kategori FROM produks a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'";
$resultProduk = mysqli_query($connection,$queryProduk);
$dataProduk = mysqli_fetch_array($resultProduk);

$namaProduk = $dataProduk['nama_kategori'];

$queryKategori = "SELECT * FROM kategori WHERE nama!='$namaProduk'";
$resultKategori = mysqli_query($connection,$queryKategori);
$quer

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php require_once(__DIR__.'/../layouts/navbar.php') ?>
  <div class="container">
    <div class="mt-5">
    <h4>Edit Produk</h4>
    <form enctype="multipart/form-data" action="" method="post">
              <label class="fs-5">Nama</label>
              <input type="text" name="nama" placeholder="tambah produk" class="form-control" required autocomplete="off" value="<?= $dataProduk['nama'] ?>">
              <label class="fs-5">Kategori</label>
              <select name="kategori" class="form-select">
                <option value="<?= $dataProduk['kategori_id']?>"><?= $dataProduk['nama_kategori'] ?></option>
                <?php while($dataKategori = mysqli_fetch_array($resultKategori)) {?>
                <option value="<?= $dataKategori['id']?>"><?= $dataKategori['nama'] ?></option>
                <?php }?>
              </select>
              <label class="fs-5">Harga</label>
              <input type="number" name="harga" class="form-control" required autocomplete="off" value="<?= $dataProduk['harga']?>">
              <label class="fs-5">Foto</label>
              <br>
              <img src="../image/<?= $dataProduk['foto']?>" alt="" width="200px">
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
              <textarea name="detail" id="" class="form-control" cols="20" rows="5" required><?= $dataProduk['detail'] ?></textarea>
              <label class="fs-5">ketersedian Stok</label>
              <select name="ketersedian_stok" class="form-select">
                <?php if($dataProduk['ketersedian_stok']=='tersedia') { ?>
                  <option value="tersedia">Tersedia</option>
                  <option value="habis">Habis</option>
                <?php }else { ?>
                  <option value="habis">Habis</option>
                  <option value="tersedia">Tersedia</option>
                <?php }  ?>
              </select>
              <button class="btn btn-primary mt-2" name="simpan">simpan</button>
            </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>