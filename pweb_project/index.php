<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
             //koneksi ke db di config.php
              include("php/config.php");
              //jika isi formulir tidak null/terisi
              if(isset($_POST['submit'])){
                //fungsi untuk menghapus karakter spesial dari email value dan dihubungkan ke sql query(php/config.php/$con) 
                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = mysqli_real_escape_string($con,$_POST['password']);
                //mengambil baris (mysqli_object) yg sesuai dgn email dan pw
                $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                //mengubah baris result menjadi associative array (array("Email"=>"xxx@gmail.com",...,...))
                $row = mysqli_fetch_assoc($result);
                //jika var row merupakan array dan tidak kosong
                if(is_array($row) && !empty($row)){
                    //menyimpan variabel assoc array ke session php
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['age'] = $row['Age'];
                    $_SESSION['id'] = $row['Id'];
                }else{
                    //tampilan password salah
                    echo "<div class='message'>
                      <p>Email atau password salah!</p>
                       </div> <br>";
                   echo "<a href='index.php'><button class='btn'>Kembali</button>";
         
                }
                
                if(isset($_SESSION['valid'])){
                    header("Location: index.html");
                }
              }else{

            
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Tidak memiliki akun? <a href="register.php">Daftar Sekarang</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>