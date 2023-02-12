
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
  <div class="container justify-content-center align-items-center">
    <div class="border border-primary p-4" style="background-color: blue;">
      <h1 class="text-center text-white">Login</h1>
      <form action='' method='post'>
        <div class="my-5 p-5 bg-body rounded shadow-sm">
          <div class="mb-4 row">
            <label class="col-sm-2 col-form-label">username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name='username' required>
            </div>
          </div>
          <div class="mb-4 row">
            <label class="col-sm-2 col-form-label">password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name='password' required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="login">Login</button></div>
          </div>
            </form>
            <?php

require_once(__DIR__.'/../koneksi.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = "SELECT * FROM users WHERE username = '$username'";

  $result = mysqli_query($connection,$query);
  $countData = mysqli_num_rows($result);

  $data = mysqli_fetch_array($result);
  
  $pesan = "";


  if($countData > 0) {
    if(password_verify($password,$data['password'])){
      $_SESSION['username'] = $data['username'];
      $_SESSION['login'] = true;
      header('location: index.php');
    } else {
      echo "
      <div class='alert alert-danger'>
      Password Salah
      </div>
      ";
    }

  } else {
    echo "
    <div class='alert alert-danger'>
    Gagal Login
    </div>
    ";
  }
}
?>
          </div>
  </div>
</div>
        <!-- AKHIR FORM -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
      </body>
      </html>