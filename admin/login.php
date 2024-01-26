<?php
date_default_timezone_set('Asia/Makassar');
session_start();
include "class/login.php";

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     $username = $_POST['username'];
//     $password = md5($_POST['password']);

//     $login = new Login();
//     $result = $login->loginUser($username, $password);

//     if ($result) {
//         $_SESSION['username'] = $username;
//         $_SESSION['user_type'] = $num_rows['user_type'];
//         header("location: index.php");
//     } else {
//         header("location: login.php?pesan=gagal");
//     }
// }
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $login = new Login();
    $result = $login->loginUser($username, $password);

    if ($result) {
        // Login berhasil
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $login->getUserType($username); // Mengambil user_type dari method getUserType
        $_SESSION['email'] = $login->getUserEmail($username); // Menambahkan session untuk email dari method getUserEmail
        header("location: index.php");
    } else {
        // Menampilkan pesan jika username benar tetapi password salah
        $userExists = $login->checkUsernameExists($username);
        if ($userExists) {
            echo "<script>alert('Password salah!')</script>";
        } else {
            // Menampilkan pesan jika keduanya salah
            echo "<script>alert('Username tidak ditemukan!')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta name="description" content="Sistem Management Mahasiswa PHP">
    <meta name="keywords" content="Sistem Management Mahasiswa PHP">
    <meta name="author" content="Ibnu Dzumirrotin">
    <meta name="author" content="https://github.com/ibnudz">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- ========== Stylesheet ========== -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- ========== Title ========== -->
    <title>Login</title>
</head>

<body class="antialiased dark:bg-gray-900 bg-gray-50">
    <main class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">

            <!-- Card -->
            <div class="w-full my-8 max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">
                    Please login to your account
                </h2>
                <form class="mt-8 space-y-6" method="POST">
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="font-medium text-gray-900 dark:text-white">Remember me</label>
                        </div>
                        <a href="#" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                    </div>
                    <button type="submit" value="Login" class="w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                </form>
            </div>
        </div>

    </main>

    <?php include "include/script.php"; ?>
</body>

</html>