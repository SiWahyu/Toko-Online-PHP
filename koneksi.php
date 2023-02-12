<?php

$connection = mysqli_connect('localhost', 'root', '', 'toko_online');
if($connection) {
  echo "Berhasil Mengkoneksi ke database";
}
?>