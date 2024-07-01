<?php 
 //mengoneksikan ke db tutorial di localhost dgn username default root
 //jika gagal memunculkan pesan
 $con = mysqli_connect("localhost","root","","tutorial") or die("Tidak dapat terhubung");

?>