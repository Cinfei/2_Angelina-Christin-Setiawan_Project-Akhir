<?php
$koneksi = mysqli_connect("localhost","root","mysql", "sams_hotel");

if(mysqli_connect_error()){
    echo "Koneksi database gagal: " . mysqli_connect_error();
}
?>
