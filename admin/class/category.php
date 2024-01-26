<?php

include "config.php";
class Category extends Database
{
    public function getAllCategories()
    {
        $query = "SELECT * FROM category";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategoryById($categoryId)
    {
        $query = "SELECT * FROM category WHERE id = '$categoryId'";
        $result = $this->con->query($query);
        return $result->fetch_assoc();
    }

    public function addCategory($categoryName, $description)
    {
        $categoryName = $this->con->real_escape_string($categoryName);
        $description = $this->con->real_escape_string($description);

        // Cek apabila kategori sudah ada
        $checkQuery = "SELECT * FROM category WHERE category_name = '$categoryName'";
        $checkResult = $this->con->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            return false;
        }

        $query = "INSERT INTO category (category_name, description) VALUES ('$categoryName', '$description')";
        return $this->con->query($query);
    }

    public function updateCategory($categoryId, $categoryName, $description)
    {
        $categoryName = $this->con->real_escape_string($categoryName);
        $description = $this->con->real_escape_string($description);

        $query = "UPDATE category SET category_name = '$categoryName', description = '$description' WHERE id = '$categoryId'";
        return $this->con->query($query);
    }

    public function deleteCategory($categoryId)
    {
        $query = "DELETE FROM category WHERE id = '$categoryId'";
        return $this->con->query($query);
    }
}
