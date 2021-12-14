<?php   
include '/app/database/Model.php';  
// include '/var/www/html/phpadminpanel/database/Model.php';  

class AdminController extends Model
{       
    public function countOfUsersProductsReviews()
    {
        $queryUsersCount = "SELECT COUNT(id) FROM users";
        $queryProductsCount = "SELECT COUNT(id) FROM products";
        $queryReviewsCount = "SELECT COUNT(id) FROM reviews";    

        $resultOfUsersCount = mysqli_query($this->getConnect(), $queryUsersCount);
        $resultOfProductsCount = mysqli_query($this->getConnect(), $queryProductsCount);
        $resultOfReviewsCount = mysqli_query($this->getConnect(), $queryReviewsCount);

        if ($resultOfUsersCount && $resultOfProductsCount && $resultOfReviewsCount) {
            $countUsers = current(mysqli_fetch_assoc($resultOfUsersCount));
            $countProducts = current(mysqli_fetch_assoc($resultOfProductsCount));
            $countReviews = current(mysqli_fetch_assoc($resultOfReviewsCount));
            $countOfUsersProductsReviews = [
                'countUsers' => $countUsers,
                'countProducts' => $countProducts,
                'countReviews' => $countReviews,
            ];
            return $countOfUsersProductsReviews;
        } else {
            echo "Error: Something went wrong";
        }
    }

    public function users()
    {
        $query = "SELECT * FROM users";
        $result = mysqli_query($this->getConnect(), $query);

        if ($sql = $this->getConnect()->query($query)) {
            $users = null;
            while ($row = mysqli_fetch_assoc($sql)) {
                $users[] = $row;
            }
            return $users;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($this->getConnect());
        }
    }
}
