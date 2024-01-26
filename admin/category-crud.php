<?php
// include "class/config.php";
include "class/category.php";

$categoryObj = new Category();
$msg = ""; // Initialize $msg
$error = ""; // Initialize $error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses tambah kategori
    if (isset($_POST['add_category'])) {
        $categoryName = $_POST['category_name'];
        $description = $_POST['description'];

        $result = $categoryObj->addCategory($categoryName, $description);

        if ($result) {
            header("location: category-add.php");
            // echo "alert('success')";
            $msg = "Kategori berhasil ditambahkan.";
            exit();
        } else {
            // header("location: category-add.php?pesan=error");
            $error = "Kategori gagal ditambahkan.";
            exit();
        }
    }

    // Proses update kategori
    if (isset($_POST['update_category'])) {
        $categoryId = $_POST['category_id'];
        $categoryName = $_POST['category_name'];
        $description = $_POST['description'];

        $result = $categoryObj->updateCategory($categoryId, $categoryName, $description);

        if ($result) {
            header("location: category-manage.php?pesan=success");
        } else {
            header("location: category-manage.php?pesan=error");
        }
    }
}

// Proses hapus kategori
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    $result = $categoryObj->deleteCategory($categoryId);

    if ($result) {
        header("location: category-manage.php?pesan=success");
    } else {
        header("location: category-manage.php?pesan=error");
    }
}
