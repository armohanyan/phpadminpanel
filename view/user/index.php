<?php
include '../../controllers/ProductController.php';

include '../includes/header.php';

$productController = new ProductController;
array_key_exists('resultOfSearch', $_SESSION) ? $products = $_SESSION['resultOfSearch'] : $products = $productController->index();

if (array_key_exists('resultOfSearch', $_SESSION)) {
    $products = $_SESSION['resultOfSearch'];
    $paginateNull = false;
} else if (array_key_exists('offset', $_GET)) {

    $products = $productController->pagination($_GET['offset']);
    $paginateNull = true;
} else {
    $products =  $productController->index();
    $paginateNull = true;
}
$countOfProducts = $productController->countOfProducts();

$limitProducts = 10;
$offset = ceil($countOfProducts / $limitProducts);

?>


<link rel="stylesheet" href="../../resource/css/admin-style.css">

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    body {
        background-color: #F3F5F7;
        font-family: 'Poppins', sans-serif;
        width: 100%;
        min-height: 100vh;
        color: #1B1C34;
    }



    .container {
        max-width: 70%;
        margin: 0 auto;
        height: 100%;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 3%;
        margin: 2% 0;
    }

    .card {
        overflow: hidden;
        padding: 5px;
        margin-right: 5px;
        margin-top: 20px;
        background-color: #FFF;
        border-radius: 30px;
        text-align: center;
        max-width: 210px !important;

    }


    .card_img img {
        width: 100%;
        height: auto;
        border-radius: 20px;
    }

    .card_body {
        padding: 10px 0px 25px 0px;
    }

    .card_title {
        font-family: 'Merriweather', serif;
        font-weight: 900;
        text-transform: capitalize;
        font-size: 26px;
    }

    .card_body p {
        font-weight: 400;
        font-size: 18px;
        line-height: 1.7;

    }

    p.card_author {
        font-size: 15px;

    }

    p.card_author a {
        color: #1B1C34;
        font-style: italic;
    }

    p.card_author a:hover {
        font-weight: bold;
    }

    a.read_more {
        color: #FFF;
        font-size: 13px;
        text-decoration: none;
        letter-spacing: 1.1px;
        background: #242e42;
        margin-top: 5px;
        padding: 12px 0px;
        border-radius: 15px;
        display: inline-block;
        width: 70%;
        transition: all .3s ease-in-out;
    }

    a.read_more:hover {
        box-shadow: 0px 1px 50px rgba(0, 0, 0, 0.15);
        background: #404040;
    }

    .link {
        position: fixed;
        background-color: #D12322;
        padding: 23px 40px;
        right: -106px;
        border-radius: 5px;
        top: 50%;
        transform: translateY(-50%);
        transform: rotate(-90deg);
        font-size: 18px;
        font-weight: 500;
        color: #FFF;
        text-decoration: none;
        text-transform: capitalize;
        transition: all .1s ease-in-out;
    }

    .link i {
        padding-left: 7px;
    }

    .link:hover {
        text-decoration: underline;
        background-color: black;
    }

    @media only screen and (max-width: 1441px) and (min-width: 1025px) {
        .container {
            max-width: 80%;
        }

        .grid {
            gap: 2%;
        }

        .card {
            padding: 15px;
        }

        .card_body {
            padding: 15px;
        }

        .card_title {
            font-size: 22px;
            padding-bottom: 14px;
        }

        .card_body p {
            font-size: 16px;
        }

        a.read_more {
            padding: 19px 0;
            width: 60%;
            font-size: 11px;
            margin-top: 30px;
        }

    }

    @media only screen and (max-width: 1024px) {

        .grid {
            grid-template-columns: 1fr;
            gap: 2%;
        }
    }

    @media only screen and (max-width: 425px) {
        .container {
            max-width: 90%;
        }

        .card {
            padding: 20px 10px;
        }

        .card_body {
            padding: 7px;
        }

        .card_title {
            font-size: 20px;
            padding-bottom: 7px;
        }

        .card_body p {
            font-size: 14px;
        }

        a.read_more {
            padding: 15px 0;
            margin-top: 20px;
        }

    }



    .pagination {
        margin: 32px auto;
        width: 38%;
        position: relative;
        background: #fff;
        display: flex;
        padding: 10px 20px;
        border-radius: 50px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .pagination>li {
        list-style: none;
        line-height: 50px;
        margin: 0 5px;
    }

    .pagination>li.pageNumber {
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
    }

    .pagination li a {
        display: block;
        text-decoration: none;
        color: #383838;
        font-weight: 600;
        border-radius: 50%;
    }

    .pagination li.pageNumber:hover a,
    .pagination li.pageNumber.active a {
        background: #383838;
        color: #fff;
    }

    .pagination li:first-child {
        margin-right: 30px;
        font-weight: 700;
        font-size: 20px;
    }

    .pagination li:last-child {
        margin-left: 30px;
        font-weight: 700;
        font-size: 20px;
    }
</style>

<body>
<div class="logout d-flex" >
    <p><?php echo $_SESSION['user']['name']. ' ' .$_SESSION['user']['surname']   ?></p>
    <a class="btn btn-pr" href="../login.php">LogOut</a>
</div>
    <section class="search-and-user">
        <form action="/../controllers/ProductController.php" method="POST">
            <input type="search" name="searchingProduct" placeholder="Search Product...">
            <button type="submit" name="searchProduct" aria-label="submit form">
                <svg aria-hidden="true">
                    <use xlink:href="#search"></use>
                </svg>
            </button>
        </form>

    </section>
    <section id="sectionOfProducts">
        <div class="container">
            <div class=" d-flex flex-wrap justify-content-center">
                <?php foreach ($products as $product) { ?>
                    <div class="card">
                        <div class="card_img">
                            <img src="<?php echo './../' . $product['image'] ?>" alt="">
                        </div>
                        <div class="card_body">
                            <h2 class="card_title"><?php echo $product['name'] ?></h2>
                            <p><?php echo $product['description'] ?></p>
                            <a href="../show-product.php?id=<?php echo $product['id'] ?>" class="read_more">Read article</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="sectionOfPagination">
        <ul class="pagination">
            <li><a href="" class="prev">
                    < Prev</a>
            </li>
            <?php
            for ($i = 1; $i <= $offset; $i++) { ?>
                <li class="pageNumber" data-id="<?php echo $i ?>"><a name="pagination" href="./index.php?offset=<?php echo ($i - 1) * 10 ?>"> <?php echo $i ?> </a></li>
            <?php } ?>
            <li><a href="" class="next">Next ></a></li>
        </ul>
    </section>
</body>
<script src="../../resource/js/admin-js.js"></script>
<script sr="../../resource/js/main.js"></script>
<script>
    $(document).ready(function() {

        $('.pagination > li').click(function() {
            localStorage.setItem('active', $(this).attr('data-id'));
        });

        let activePage = localStorage.getItem('active');

        console.log(localStorage.getItem('active1') != null)

        if (localStorage.getItem('active1') != null) {
            let activePageAfterNext = localStorage.getItem('active1');
            $(`li[data-id=${activePageAfterNext}]`).addClass('active');
        } else if (localStorage.getItem('active') != null) {
            $(`li[data-id=${activePage}]`).addClass('active');
        } else {
            $(`li[data-id=1]`).addClass('active');
        }

        $(".next").click(function(e) {
            let getNextElementHref = $(".pagination").find(".pageNumber.active").next().find('a').attr('href');
            let next = $(".pagination").find(".pageNumber.active").next()
            $(".pagination").find(".pageNumber.active").prev().removeClass("active");
            next.addClass("active");

            let nextDataId = next.attr('data-id');
            localStorage.setItem('active1', nextDataId);

            $(this).attr('href', getNextElementHref);
        });


        $(".prev").click(function(e) {
            let getPrevElementHref = $(".pagination").find(".pageNumber.active").prev().find('a').attr('href');
            let prev = $(".pagination").find(".pageNumber.active").prev()
            prev.addClass("active");
            $(".pagination").find(".pageNumber.active").next().removeClass("active");

            let prevDataId = prev.attr('data-id');
            localStorage.setItem('active1', prevDataId);

            $(this).attr('href', getPrevElementHref);

        });

        localStorage.removeItem("active");
        localStorage.removeItem("active1");
    });
</script>

</html>