<?php
    session_start();

    // Mengecek role yang dimiliki pengguna, jika tidak ada session atau tidak login, 
    // otomatis akan kembali terarah ke index.php
    if (!isset($_SESSION['role'])) {
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>  
      
    <p>Anda login sebagai: <?php echo htmlspecialchars($_SESSION['role']); ?></p>
    
    <?php
        // if ($_SESSION['role']=='superadmin') {
        //     echo "<h1>Selamat Datang Tuan, " . $_SESSION['username'] . "</h1>";
        // } elseif ($_SESSION['role']=='admin') {
        //     echo "<h1>Selamat Datang, " . $_SESSION['username'] . "</h1>";
        // } elseif ($_SESSION['role']=='regular') {
        //     echo "<h1>Hai, " . $_SESSION['username'] . "</h1>";
        // }

        //Perbaikan code menggunakan array
                    
        // Pesan selamat datang sesuai role
        $pesan = [
            'superadmin'=> 'Selamat Datang Tuan',
            'admin'=> 'Selamat Datang',
            'regular'=> 'Hai'
        ];

        $role = $_SESSION['role'];
        $username = htmlspecialchars($_SESSION['username']);
        echo "<h1>{$pesan[$role]}, {$username}</h1>" 

    ?>

    <!-- Logout Function -->
    <a href="logout.php">LogOut</a>

</body>
</html>