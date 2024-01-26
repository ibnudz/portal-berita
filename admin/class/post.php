<?php

// include "config.php";
include "subcategory.php";


class Post extends Subcategory
{
    public function getAllPosts()
    {
        $query = "SELECT posts.*, category.category_name as category_name, subcategory.subcategory_name as subcategory_name, 
                          users.username as posted_by_username, users_updated.username as last_update_by_username
                  FROM posts
                  LEFT JOIN category ON posts.id_category = category.id
                  LEFT JOIN subcategory ON posts.id_subcategory = subcategory.id
                  LEFT JOIN users ON posts.posted_by = users.id
                  LEFT JOIN users AS users_updated ON posts.last_update_by = users_updated.id";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostById($postId)
    {
        $query = "SELECT * FROM posts WHERE id = '$postId'";
        $result = $this->con->query($query);
        return $result->fetch_assoc();
    }

    // public function addPost($postTitle, $categoryId, $subcategoryId, $postDescription, $postSlug, $postImage, $postedBy, $lastUpdateBy)
    // {
    //     $postTitle = $this->con->real_escape_string($postTitle);
    //     $postDescription = $this->con->real_escape_string($postDescription);
    //     $postSlug = $this->con->real_escape_string($postSlug);
    //     $postImage = $this->con->real_escape_string($postImage);

    //     $query = "INSERT INTO posts (post_title, id_category, id_subcategory, post_description, post_slug, post_image, posted_by, last_update_by) VALUES ('$postTitle', '$categoryId', '$subcategoryId', '$postDescription', '$postSlug', '$postImage', '$postedBy', '$lastUpdateBy')";
    //     return $this->con->query($query);
    // }
    public function addPost($postTitle, $categoryId, $subcategoryId, $postDescription, $postSlug, $postImage, $postedBy, $lastUpdateBy)
    {
        $postTitle = $this->con->real_escape_string($postTitle);
        $postDescription = $this->con->real_escape_string($postDescription);
        $postSlug = $this->con->real_escape_string($postSlug);

        // Validasi file gambar
        if (!$this->isImageValid($postImage)) {
            return false; // File bukan gambar
        }

        // Menentukan lokasi penyimpanan gambar pada folder dokumen
        $uploadDir = 'dokumen/';
        $uploadFile = $uploadDir . basename($postImage['name']);

        // Menyimpan gambar ke folder dokumen
        if (move_uploaded_file($postImage['tmp_name'], $uploadFile)) {
            // Gambar berhasil diupload, lanjutkan dengan menyimpan data ke database
            $query = "INSERT INTO posts (post_title, id_category, id_subcategory, post_description, post_slug, post_image, posted_by, last_update_by) VALUES ('$postTitle', '$categoryId', '$subcategoryId', '$postDescription', '$postSlug', '$uploadFile', '$postedBy', '$lastUpdateBy')";
            return $this->con->query($query);
        } else {
            // Gagal menyimpan gambar
            return false;
        }
    }

    // Metode untuk memeriksa apakah file adalah gambar
    public function isImageValid($file)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        // Periksa apakah file tersebut diunggah dan adalah gambar
        if (is_uploaded_file($file['tmp_name']) && ($imageInfo = getimagesize($file['tmp_name'])) !== false) {
            // Periksa apakah tipe gambar diizinkan
            return in_array($imageInfo['mime'], $allowedTypes);
        }

        return false;
    }


    public function updatePost($postId, $postTitle, $categoryId, $subcategoryId, $postDescription, $postSlug, $postImage, $lastUpdateBy)
    {
        $postTitle = $this->con->real_escape_string($postTitle);
        $postDescription = $this->con->real_escape_string($postDescription);
        $postSlug = $this->con->real_escape_string($postSlug);
        // $postImage = $this->con->real_escape_string($postImage);

        // Validasi file gambar
        if (!$this->isImageValid($postImage)) {
            return false; // File bukan gambar
        }

        // Menentukan lokasi penyimpanan gambar pada folder dokumen
        $uploadDir = 'dokumen/';
        $uploadFile = $uploadDir . basename($postImage['name']);

        // Menyimpan gambar ke folder dokumen
        if (move_uploaded_file($postImage['tmp_name'], $uploadFile)) {
            // Gambar berhasil diupload, lanjutkan dengan menyimpan data ke database
            $query = "UPDATE posts SET post_title = '$postTitle', id_category = '$categoryId', id_subcategory = '$subcategoryId', post_description = '$postDescription', post_slug = '$postSlug', post_image = '$uploadFile', last_update_by = '$lastUpdateBy' WHERE id = '$postId'";
            return $this->con->query($query);
        } else {
            // Gagal menyimpan gambar
            return false;
        }

        // $query = "UPDATE posts SET post_title = '$postTitle', id_category = '$categoryId', id_subcategory = '$subcategoryId', post_description = '$postDescription', post_slug = '$postSlug', post_image = '$postImage', last_update_by = '$lastUpdateBy' WHERE id = '$postId'";
        // return $this->con->query($query);
    }

    public function deletePost($postId)
    {
        $query = "DELETE FROM posts WHERE id = '$postId'";
        return $this->con->query($query);
    }

    // Inside your Post class (Post.php)
    public function getPostBySlug($slug)
    {
        $slug = $this->con->real_escape_string($slug);
        $query = "SELECT posts.*, category.category_name as category_name, subcategory.subcategory_name as subcategory_name, 
                      users.username as posted_by_username, users_updated.username as last_update_by_username
              FROM posts
              LEFT JOIN category ON posts.id_category = category.id
              LEFT JOIN subcategory ON posts.id_subcategory = subcategory.id
              LEFT JOIN users ON posts.posted_by = users.id
              LEFT JOIN users AS users_updated ON posts.last_update_by = users_updated.id
              WHERE posts.post_slug = '$slug'";

        $result = $this->con->query($query);
        return $result->fetch_assoc();
    }

    public function addComment($postId, $name, $email, $commentText)
    {
        $name = $this->con->real_escape_string($name);
        $email = $this->con->real_escape_string($email);
        $commentText = $this->con->real_escape_string($commentText);

        $query = "INSERT INTO comments (id_post, name, email, comment, comment_date) 
                  VALUES ('$postId', '$name', '$email', '$commentText', CURRENT_TIMESTAMP)";

        return $this->con->query($query);
    }

    public function getCommentsByPostId($postId)
    {
        $query = "SELECT * FROM comments WHERE id_post = '$postId' ORDER BY comment_date DESC";
        $result = $this->con->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
