<?php
include '/var/www/html/phpadminpanel/database/Model.php';

class ProductController extends Model
{

    public function index()
    {
        $query = "SELECT * FROM products";

        if ($sql = $this->getConnect()->query($query)) {
            $products = null;
            while ($row = mysqli_fetch_assoc($sql)) {
                $products[] = $row;
            }
            return $products;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($this->getConnect());
        }
    }

    public function show($id)
    {

        $query = "SELECT * FROM `products` WHERE id='$id'";

        if ($sql = $this->getConnect()->query($query)) {
            $product = null;
            while ($row = mysqli_fetch_assoc($sql)) {
                $product[] = $row;
            }
            return current($product);
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($this->getConnect());
        }
    }

    public function storeReview()
    {
        if (isset($_POST['submitReview'])) {
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];
            $productId = $_POST['submitReview'];
            if (empty($rating) && empty($comment)) {
                header('Location:../view/admin/show-product.php?id=' . $productId);
            }
            //  else {
            //      $query = "INSERT INTO `reviews` (`name`, `description`, `image`) 
            //                 VALUES ('$productName', '$productDescription', '$uploadPath')";
            // }

        }
    }

    public function create()
    {
        if (isset($_POST['createProduct'])) {

            $uploadDirectory = "../public/images/";
            $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
            $fileName = $_FILES['image']['name'];
            $fileSize = $_FILES['image']['size'];
            $productName = $_POST['name'];
            $productDescription = $_POST['description'];
            $fileTmpName  = $_FILES['image']['tmp_name'];
            $expodeFile = explode('.', $fileName);
            $fileExtension = strtolower(end($expodeFile));
            $newfilename = round(microtime(true)) . '.' . $fileExtension;
            $errors = [];
            $uploadPath =  $uploadDirectory . $newfilename;

            if (!in_array($fileExtension, $fileExtensionsAllowed)) {
                $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
            }

            if ($fileSize > 25000000) {
                $errors[] = "File exceeds maximum size (25MB)";
            }

            if (empty($productName) && empty($productDescription)) {
                $errors[] = "Empty field(s)";
            }
            $_SESSION['errors'] = $errors;
            if (empty($errors)) {

                move_uploaded_file($fileTmpName, $uploadPath);
                $query = "INSERT INTO `products` (`name`, `description`, `image`) 
                         VALUES ('$productName', '$productDescription', '$uploadPath')";

                if (mysqli_query($this->getConnect(), $query)) {
                    header('Location:../view/admin/create-product.php');
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($this->getConnect());
                }
            } else {
                foreach ($errors as $error) {
                    echo $error . "These are the errors" . "\n";
                }
            }
        }
    }
}

$productController = new ProductController;
$productController->create();
$productController->storeReview();
