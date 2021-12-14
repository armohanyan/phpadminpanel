<?php
session_start();
include '/app/database/Model.php';
// include '/var/www/html/phpadminpanel/database/Model.php';  

class ProductController extends Model
{

    public function index()
    {
        $query = "SELECT * FROM products limit 10";

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

    public function pagination($offset)
    {
        $query = "SELECT * FROM products LIMIT 10 OFFSET $offset";

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

    public function countOfProducts()
    {
        $query = "SELECT count(*)c from products";

        if ($sql = $this->getConnect()->query($query)) {
            $countOfProduct = current(mysqli_fetch_assoc($sql));
            return $countOfProduct;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($this->getConnect());
        }
    }

    public function show($id)
    {
        $query = "SELECT * FROM `products` WHERE id='$id'";
        $reviewQuery = "SELECT * FROM `reviews` WHERE product_id='$id'";
        $countOfStars = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $productAndReviews = [];
        $product = NULL;
        $reviews = NULL;
        $sumOfStars = 0;
        $count = 0;

        if ($sqlProduct = $this->getConnect()->query($query)) {

            while ($row = mysqli_fetch_assoc($sqlProduct)) {
                $product[] = $row;
            }

            array_push($productAndReviews, current($product));

            if ($sqlReview = $this->getConnect()->query($reviewQuery)) {
                while ($rowReviews = mysqli_fetch_assoc($sqlReview)) {
                    if ($rowReviews['stars'] != null) {
                        $sumOfStars += $rowReviews['stars'];
                        $countOfStars[$rowReviews['stars']] += 1;
                        $count++;
                    }
                    $reviews[] = $rowReviews;
                }
            } else {
                echo "Error: " . $reviewQuery . "<br>" . mysqli_error($this->getConnect());
            }

            $count == 0 ? $avgRating = 0 : $avgRating = $sumOfStars / $count;
            if ($reviews) {
                array_reverse($reviews);
            }
            array_push($productAndReviews, $reviews,  $countOfStars, round($avgRating, 1));

            return $productAndReviews;
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
            $raterUser = $_SESSION['user']['username'];

            if (empty($rating) && empty($comment)) {
                header('Location:../view/admin/show-product.php?id=' . $productId);
            } else {

                if (empty($rating)) {
                    $rating = 'NULL';
                }

                $query = "INSERT INTO `reviews` (`username`, `product_id`, `stars`, `comment`) 
                        VALUES ('$raterUser', '$productId', $rating, '$comment')";

                if (mysqli_query($this->getConnect(), $query)) {
                    header('Location:../view/admin/show-product.php?id=' . $productId);
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($this->getConnect());
                }
            }
        }
    }

    public function search()
    {
        if (isset($_POST['searchProduct'])) {
            if (!empty($_POST['searchingProduct'])) {

                $searchProduct = $_POST['searchingProduct'];
                $query = "SELECT * FROM products where name like '%$searchProduct%'";

                if ($sql = $this->getConnect()->query($query)) {
                    $resultOfSearch = null;
                    while ($row = mysqli_fetch_assoc($sql)) {
                        $resultOfSearch[] = $row;
                    }
                    $_SESSION['resultOfSearch'] = $resultOfSearch;
                    header('Location:../view/admin/products.php');
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($this->getConnect());
                }
            } else {
                header('Location:../view/admin/products.php');
            }
        }
    }

    public function create()
    {
        if (isset($_POST['createProduct'])) {
            $productDescription = $_POST['description'];
            $productName = $_POST['name'];
            if (isset($_POST['image'])) {
                $uploadDirectory = "../public/images/";
                $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
                $fileName = $_FILES['image']['name'];
                $fileSize = $_FILES['image']['size'];
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
            } else {
                $uploadPath = null;
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
$productController->search();
$productController->storeReview();
