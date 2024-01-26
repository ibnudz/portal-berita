<?php
include "admin/class/Post.php";


$postObj = new Post();

// Mengambil data post berdasarkan slug url
$slug = $_GET['slug'];
// Mengambil detail post berdasarkan slug url
$post = $postObj->getPostBySlug($slug);

// cek apakah form komentar sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // mengambil data dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $commentText = $_POST['comment'];

    // Amenambahkan komentar ke database
    $postObj->addComment($post['id'], $name, $email, $commentText);
}

// mengambil semua komentar berdasarkan id post
$comments = $postObj->getCommentsByPostId($post['id']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Berita | <?= strtoupper($post['post_title']); ?></title>
</head>

<body class="antialiased dark:bg-gray-900 bg-gray-50">
    <!-- HEADER START -->
    <header class="sticky top-0 z-40 flex-none w-full mx-auto bg-white border-b border-gray-200 dark:border-gray-600 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 bg-white border-gray-200 dark:bg-gray-900">
            <a href="index.php" class="flex items-center">
                <img src="assets/img/logo.png" class="h-8 mr-3" alt="" />
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="akira font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="/" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Home</a>
                    </li>
                    <li>
                        <a href="#about" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">FAQ</a>
                    </li>
                    <li>
                        <a href="" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Sign In</a>
                    </li>
                    <li>
                        <a href="" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Sign Up</a>
                    </li>
                    <li>
                        <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm md:p-0 ml-2">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- HEADER END -->

    <!-- MAIN CONTENT START -->
    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 dark:bg-gray-900">
        <main>
            <div class="px-4 pt-6">
                <div class="container mx-auto mt-8">
                    <article class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"><?= $post['category_name']; ?></span>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300"><?= $post['subcategory_name']; ?></span>
                        <h2 class="text-3xl font-semibold mb-4 dark:text-white"><?= strtoupper($post['post_title']); ?></h2>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">by <?= $post['posted_by']; ?> | <?= $post['posting_date']; ?></p>
                        <img src="admin/<?= $post['post_image']; ?>" alt="<?= $post['post_title']; ?>" class="h-auto max-w-full rounded-lg">
                        <p class="text-gray-600 dark:text-gray-400"><?= $post['post_description']; ?></p>
                    </article>

                    <!-- Comment Form -->
                    <div class="mt-8">
                        <h3 class="text-2xl font-semibold mb-4 dark:text-white">Tinggalkan Komentar anda</h3>
                        <form method="POST" action="">
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 dark:text-gray-300">Nama:</label>
                                <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700 dark:text-gray-300">Email:</label>
                                <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300">
                            </div>
                            <div class="mb-4">
                                <label for="comment" class="block text-gray-700 dark:text-gray-300">Komentar:</label>
                                <textarea id="comment" name="comment" rows="4" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300"></textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300">Submit Comment</button>
                        </form>
                    </div>

                    <!-- Display Comments -->
                    <div class="mt-8">
                        <h3 class="text-2xl font-semibold mb-4 dark:text-white">Komentar</h3>
                        <?php foreach ($comments as $comment) : ?>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md mb-4">
                                <p class="text-gray-800 dark:text-white"><strong><?= $comment['name']; ?></strong>:</p>
                                <p class="text-gray-600 dark:text-gray-400"><?= $comment['comment']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- MAIN CONTENT END -->

    <!-- FOOTER START -->
    <footer class="mt-8 p-4 bg-white sm:p-6 dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl border-t-[1px] dark:border-gray-600 pt-10">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0 w-60">
                    <a href="/" class="flex-col items-center">
                        <div class="flex items-center">
                            <img src="assets/img/logo.png" class="h-auto max-w-md mr-3" alt="Country News" />
                        </div>
                        <a href="https://goo.gl/maps/aY5nBUw9ruNQesr6A" class="flex-col items-center">
                            <p class="mt-3 text-gray-600 dark:text-gray-400">
                                <i class="fa-solid fa-location-dot"></i> Jl. Raya Puputan No.86, Dangin Puri Klod, Kec. Denpasar Tim., Kota Denpasar, Bali 80234
                            </p>
                        </a>
                    </a>
                </div>
                <!-- <div>
                    <h2 class="md:mb-6 mb-3 text-sm font-semibold text-gray-900 uppercase dark:text-white">Competition</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Adzan</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Da'i</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Pop Religi</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Tilawah</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Puisi Islami</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Tahfidz</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Desain Poster Islami</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Kaligrafi</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Futsal</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Ranking 1</a>
                        </li>
                    </ul>
                </div> -->
                <div class="mt-5 md:mt-0">
                    <h2 class="md:mb-6 mb-3 text-sm font-semibold text-gray-900 uppercase dark:text-white">Contact Us</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li class="mb-4">
                            <i class="fa-brands fa-whatsapp"></i><a href="#" class="hover:underline">+6281234567898 (Noname)</a>
                        </li>
                        <!-- <li class="mb-4">
                            <i class="fa-brands fa-whatsapp"></i><a href="#" class="hover:underline">+6281234567898 (Noname)</a>
                        </li>
                        <li class="mb-4">
                            <i class="fa-brands fa-whatsapp"></i><a href="#" class="hover:underline">+6281234567898 (Noname)</a>
                        </li>
                        <li>
                            <i class="fa-brands fa-whatsapp"></i><a href="#" class="hover:underline">+6281234567898 (Noname)</a>
                        </li> -->
                    </ul>
                </div>
                <div class="mt-5 md:mt-0">
                    <h2 class="md:mb-6 mb-3 text-sm font-semibold text-gray-900 uppercase dark:text-white">Section</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Home</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">About</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">FAQ</a>
                        </li>
                        <li class="mb-4">
                            <a href="" class="hover:underline">Sign In</a>
                        </li>
                        <li>
                            <a href="" class="hover:underline">Sign Up</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                    Copyright &copy; <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template created by IT Support™.
                </span>
                <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                    <a href="https://www.instagram.com/ibnubert_/" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <i class="fa-brands fa-instagram text-xl hover:text-pink-600"></i>
                    </a>
                    <a href="https://www.youtube.com/@ibnubert" target="_blank" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                        <i class="fa-brands fa-youtube text-xl hover:text-red-600"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->

    <!-- ========== JAVASCRIPT ========== -->
    <script src="assets/js/dark-mode.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>