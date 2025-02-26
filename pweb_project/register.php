<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
         //koneksi ke db
         include("php/config.php");
         //jika submit diisi(tidak null)
         if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $password = $_POST['password'];

         //verifying the unique email
        //mysqli_query(koneksi,query)
        //pilih email dari tabel user di db yang sesuai dengan input form
         $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");
        //jika ditemukan email yg sesuai, muncul pesan email sudah digunakan
         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>Email ini telah digunakan, cobalah email yang lain!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Kembali</button>";
         }
         //jika email belum ditemukan
         else{
            //memasukkan input form ke db
            mysqli_query($con,"INSERT INTO users(Username,Email,Age,Password) VALUES('$username','$email','$age','$password')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Registrasi berhasil</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Masuk sekarang!</button>";
         

         }

         }else{
         
        ?>

            <header>Daftar</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Umur</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Kata sandi</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Daftar" required>
                </div>
                <div class="links">
                    Sudah memiliki akun? <a href="index.php">Masuk</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>