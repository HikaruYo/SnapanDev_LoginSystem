<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <form method="POST">
        <?php
            session_start();

            //Koneksi database
            include "connection.php";

            // Login logic
            if(isset($_POST['login'])) {
                // Mengambil data dari input pengguna
                $user = $_POST['username'];
                $pass = $_POST['password'];

                // Mengambil data dari database dimana 'username' disimpan sebagai '$user',
                // 'password' disimpan sebagai '$pass', dan mengambil role yang dimiliki user
                // $query = "SELECT * FROM users, roles WHERE users.username='$user' AND users.password='$pass' AND users.role_id = roles.id";
                // $result = mysqli_query($connection, $query);
                // $data = mysqli_fetch_assoc($result);

                // Perbaikan code untuk mencegah SQL Injection menggunakan prepared statements
                $stmt = $connection->prepare("SELECT users.username, roles.role FROM users JOIN roles ON users.role_id = roles.id WHERE users.username = ? AND users.password = ?");
                $stmt->bind_param("ss", $user, $pass);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_assoc();

                // Mengecek apakah data yang dikirim user sesuai atau tidak di database
                if($data) {
                    $_SESSION['role']=$data['role'];
                    $_SESSION['username']=$data['username'];
                    header('location:dashboard.php'); 
                    // Jika sesuai, session akan diatur dan pengguna akan diarahkan ke dashboard.php
                } else {
                    echo "Akun anda tidak terdaftar" . PHP_EOL;
                }
            }
        ?>

        <!-- Input form -->
        <div class="form">        
            <div class="form-group">
                <input type="username" class="username" name="username" placeholder="Username" required>
            </div>
            <br>
            <div class="form-group">
                <input type="password" class="password" name="password" placeholder="Password" required>
            </div>
            <br>
            <button name="login" type="submit">Login</button>
            <!-- Logout Function -->
            <?php

                // Jika user masih memiliki session dan mencoba untuk mengakses index.php,
                // Akan muncul tombol logout dan user dapat mengklik untuk mengakhiri session
                if (isset($_SESSION['role'])) {
                    echo '<a href="logout.php">LogOut</a>';
                };

            ?>
        </div>
    </form>
</body>
</html>
