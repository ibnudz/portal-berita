<?php
include "Category.php";

class Subcategory extends Category
{
    public function getAllSubcategories()
    {
        // $query = "SELECT * FROM subcategory";
        $query = "SELECT subcategory.*, category.category_name as category_name FROM subcategory 
                  LEFT JOIN category ON subcategory.id_category = category.id";
        $result = $this->con->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubcategoryById($subcategoryId)
    {
        $query = "SELECT * FROM subcategory WHERE id = '$subcategoryId'";
        $result = $this->con->query($query);
        return $result->fetch_assoc();
    }

    public function addSubcategory($idCategory, $subcategoryName, $subcategoryDescription)
    {
        $subcategoryName = $this->con->real_escape_string($subcategoryName);
        $subcategoryDescription = $this->con->real_escape_string($subcategoryDescription);

        // Cek apakah subkategori sudah ada
        $checkQuery = "SELECT * FROM subcategory WHERE subcategory_name = '$subcategoryName'";
        $checkResult = $this->con->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            return false;
        }

        $query = "INSERT INTO subcategory (id_category, subcategory_name, subcategory_description) VALUES ('$idCategory', '$subcategoryName', '$subcategoryDescription')";
        return $this->con->query($query);
    }

    public function updateSubcategory($subcategoryId, $idCategory, $subcategoryName, $subcategoryDescription)
    {
        $subcategoryName = $this->con->real_escape_string($subcategoryName);
        $subcategoryDescription = $this->con->real_escape_string($subcategoryDescription);

        $query = "UPDATE subcategory SET id_category = '$idCategory', subcategory_name = '$subcategoryName', subcategory_description = '$subcategoryDescription' WHERE id = '$subcategoryId'";
        return $this->con->query($query);
    }

    public function deleteSubcategory($subcategoryId)
    {
        $query = "DELETE FROM subcategory WHERE id = '$subcategoryId'";
        return $this->con->query($query);
    }
}
?>
