<?php 

require_once(__DIR__.'/../koneksi.php');

  $id = $_GET['id'];

  $query = "SELECT * FROM kategori WHERE id='$id'";

  $result = mysqli_query($connection,$query);

  $data = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kategori</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
  <?php require_once(__DIR__.'/../layouts/navbar.php') ?>
  <div class="container">
    <div class="mt-5">
    <h4>Edit Kategori</h4>
    <form action="" method="post">
      <label class="fs-5">Kategori</label>
      <input type="text" name="edit_kategori" class="form-control" value="<?=$data['nama']?>">
      <?php 
      if(isset($_POST['simpan'])){
        $edit_kategori = $_POST['edit_kategori'];
        
        $queryCekKategori = "SELECT nama FROM kategori WHERE nama='$edit_kategori'";
        
        $resultCek = mysqli_query($connection,$queryCekKategori);
  
        $row = mysqli_num_rows($resultCek);

        if($row > 0) {
          echo "
          <div class='alert alert-danger mt-2' role='alert'>
          Kategori sudah ada
          </div>
          ";
        } else {

          $edit_cek = htmlspecialchars($edit_kategori);
          
          $queryUpdt = "UPDATE kategori SET nama='$edit_cek' WHERE id='$id'";
          $resultUpdt = mysqli_query($connection,$queryUpdt);
          echo "
          <script>
          setInterval( () => {
            window.location.href = 'kategori.php';
         },1400);
          </script>
          <div class='alert alert-success mt-2' role='alert'>
          Berhasil merubah kategori
          </div>
          ";
        }
      }
      ?>
      <button class="btn btn-primary mt-2" name="simpan">simpan</button>
    </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>