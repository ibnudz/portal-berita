<?php

include "include/session.php";
#include "class/login.php";
include "class/home.php";

$categoryObj = new Category();
$subcategoryObj = new Subcategory();
$postObj = new Post();

$categories = $categoryObj->getAllCategories();
$subcategories = $subcategoryObj->getAllSubcategories();
$posts = $postObj->getAllPosts();

$totalCategories = $categoryObj->getTotalCategories();
$totalSubcategories = $subcategoryObj->getTotalSubcategories();
$totalPosts = $postObj->getTotalPosts();
?>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <?php include "include/head.php"; ?>
    <title>Dashboard Panel</title>
</head>

<body class="antialiased dark:bg-gray-900 bg-gray-50">
    <?php include "include/navbar.php"; ?>

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php include("include/sidebar.php"); ?>

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <div class="px-4 pt-6">
                    <div class="mb-4">
                        <nav class="flex mb-5" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                                <li class="inline-flex items-center">
                                    <a href="#" class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                        <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                            </ol>
                        </nav>
                        <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Dashboard Panel</h1>
                    </div>
                    <div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-3 2xl:grid-cols-4">
                        <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="w-full">
                                <span class="text-base font-normal text-gray-500 dark:text-gray-400">Kategori</span>
                                <div class="flex items-center text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                    <span class="flex-auto text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"><?= $totalCategories; ?></span>
                                    <svg class="w-16 h-16 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                                        <path d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM72 272a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm104-16H304c8.8 0 16 7.2 16 16s-7.2 16-16 16H176c-8.8 0-16-7.2-16-16s7.2-16 16-16zM72 368a24 24 0 1 1 48 0 24 24 0 1 1 -48 0zm88 0c0-8.8 7.2-16 16-16H304c8.8 0 16 7.2 16 16s-7.2 16-16 16H176c-8.8 0-16-7.2-16-16z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="w-full">
                                <span class="text-base font-normal text-gray-500 dark:text-gray-400">Sub Kategori</span>
                                <div class="flex items-center text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                    <span class="flex-auto text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"><?= $totalSubcategories; ?></span>
                                    <svg class="w-16 h-16 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                                        <path d="M64 32C64 14.3 49.7 0 32 0S0 14.3 0 32v96V384c0 35.3 28.7 64 64 64H256V384H64V160H256V96H64V32zM288 192c0 17.7 14.3 32 32 32H544c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32H445.3c-8.5 0-16.6-3.4-22.6-9.4L409.4 9.4c-6-6-14.1-9.4-22.6-9.4H320c-17.7 0-32 14.3-32 32V192zm0 288c0 17.7 14.3 32 32 32H544c17.7 0 32-14.3 32-32V352c0-17.7-14.3-32-32-32H445.3c-8.5 0-16.6-3.4-22.6-9.4l-13.3-13.3c-6-6-14.1-9.4-22.6-9.4H320c-17.7 0-32 14.3-32 32V480z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="w-full">
                                <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Berita</h3>
                                <div class="flex items-center text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                                    <span class="flex-auto text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white"><?= $totalPosts; ?></span>
                                    <svg class="w-16 h-16 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" height="16" width="18" viewBox="0 0 576 512">
                                        <path d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700 my-4">
                        <div class="w-full mb-1">
                            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Postingan Berita Terbaru</h1>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow">
                                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600" id="example">
                                        <thead class="bg-gray-100 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    NO
                                                </th>
                                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Judul
                                                </th>
                                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Kategori
                                                </th>
                                                <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                    Sub Kategori
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                            <?php
                                            $counter = 1;
                                            foreach ($posts as $post) {
                                            ?>
                                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $counter++; ?></td>
                                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $post['post_title']; ?></td>
                                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <?php
                                                        foreach ($categories as $category) {
                                                            if ($category['id'] == $post['id_category']) {
                                                                echo $category['category_name'];
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <?php
                                                        foreach ($subcategories as $subcategory) {
                                                            if ($subcategory['id'] == $post['id_subcategory']) {
                                                                echo $subcategory['subcategory_name'];
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <?php include("include/footer.php"); ?>
        </div>
    </div>

    <?php include "include/script.php"; ?>
</body>

</html>