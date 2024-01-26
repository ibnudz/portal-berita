<?php
include "include/session.php";
// include "class/subcategory.php";
include "class/post.php";

$category = new Category();
$categories = $category->getAllCategories();
$subcategoryObj = new Subcategory();
$subcategories = $subcategoryObj->getAllSubcategories();
$postObj = new Post();
$msg = ""; // Initialize $msg
$error = ""; // Initialize $error

if (isset($_GET['id'])) {
    $postId = $_GET["id"];
    $post = $postObj->getPostById($postId);
} else {
    header("location: post-managed.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses tambah berita
    if (isset($_POST['update_post'])) {
        // Ambil data dari formulir
        $postTitle = $_POST["post_title"];
        $categoryId = $_POST["category_id"];
        $subcategoryId = $_POST["subcategory_id"];
        $postDescription = $_POST["post_description"];
        $postSlug = $_POST["post_slug"];
        $postImage = $_FILES["post_image"];
        $postedBy = $_SESSION["username"];
        $lastUpdateBy = $_SESSION["username"];

        // Panggil fungsi untuk memperbarui post
        $result = $postObj->updatePost($postId, $postTitle, $categoryId, $subcategoryId, $postDescription, $postSlug, $postImage, $lastUpdateBy);

        if ($result) {
            $msg = "Berita berhasil diupdate.";
            // Update value berita jika berhasil
            $post['post_title'] = $postTitle;
            $post['id_category'] = $categoryId;
            $post['id_subcategory'] = $subcategoryId;
            $post['post_description'] = $postDescription;
            $post['post_slug'] = $postSlug;
            $post['post_image'] = $postImage;
        } else {
            $error = "Berita gagal diupdate.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <?php include "include/head.php"; ?>
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
    <title>Update Berita</title>
</head>

<body class="antialiased dark:bg-gray-900 bg-gray-50">
    <?php include "include/navbar.php"; ?>

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php include("include/sidebar.php"); ?>

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <div class="px-4 pt-6">
                    <div class="mb-4">
                        <!-- Breadcrumb -->
                        <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                <li class="inline-flex items-center">
                                    <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Berita</a>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Edit Berita</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>
                        <div class="my-4">
                            <h1 class="mb-10 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Edit Berita</h1>
                        </div>
                        <!-- success message -->
                        <?php if ($msg) { ?>
                            <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div class="ms-3 text-sm font-medium">
                                    <?= htmlentities($msg); ?>
                                </div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        <?php } ?>
                        <!-- error message -->
                        <?php if ($error) { ?>
                            <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div class="ms-3 text-sm font-medium">
                                    <?= htmlentities($error); ?>
                                </div>
                                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="flex flex-col items-center justify-center py-6 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
                        <div class="w-full p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
                            <form class="mx-auto" method="POST" action="" enctype="multipart/form-data">
                                <div class="grid grid-cols-6 gap-2">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="post_title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Berita</label>
                                        <input type="text" name="post_title" id="post_title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?= $post['post_title']; ?>" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="post_slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug Berita</label>
                                        <input type="text" name="post_slug" id="post_slug" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?= $post['post_slug']; ?>" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                        <select id="category_id" name="category_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 pr-8 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <?php foreach ($categories as $cat) :
                                                $selected = ($cat['id'] == $post['id_category']) ? 'selected' : '';
                                            ?>
                                                <option value="<?= $cat['id']; ?>" <?= $selected; ?>><?= $cat['category_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="subcategory_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                        <select id="subcategory_id" name="subcategory_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 pr-8 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <?php foreach ($subcategories as $sub) :
                                                $selected = ($sub['id'] == $post['id_subcategory']) ? 'selected' : '';
                                            ?>
                                                <option value="<?= $sub['id']; ?>" <?= $selected; ?>><?= $sub['subcategory_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="post_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Gambar</label>
                                        <input id="post_image" name="post_image" accept="image/*" type="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                                    </div>
                                    <div class="col-span-6">
                                        <label for="post_description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                        <textarea name="post_description" id="" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required><?= $post['post_description']; ?></textarea>
                                    </div>
                                    <div class="col-span-6">
                                        <label for="post_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                                        <?php if (!empty($post['post_image'])) : ?>
                                            <img src="<?= $post['post_image']; ?>" alt="" class="w-20 h-20">
                                        <?php else : ?>
                                            <p>Gambar tidak tersedia</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="items-center pt-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                                    <button type="submit" name="update_post" class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Berita</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </main>

            <?php include("include/footer.php"); ?>
        </div>
    </div>

    <?php include "include/script.php"; ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fungsi untuk menghasilkan slug dari judul berita
            function generateSlug(title) {
                return title
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-') // Hapus karakter yang tidak diinginkan
                    .replace(/^-+|-+$/g, ''); // Hapus "-" di awal dan akhir
            }

            // Ambil elemen judul berita dan slug
            var titleInput = document.getElementById('post_title');
            var slugInput = document.getElementById('post_slug');

            // Tambahkan event listener untuk memperbarui slug saat judul berubah
            titleInput.addEventListener('input', function() {
                var titleValue = titleInput.value;
                var generatedSlug = generateSlug(titleValue);
                slugInput.value = generatedSlug;
            });
        });
    </script>
</body>

</html>