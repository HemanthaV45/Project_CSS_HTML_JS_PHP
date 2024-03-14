<?php

include 'components/connect.php';

session_start();
if(isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id'];
}else{
    $user_id='';
}

include 'components/add_cart.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>

    <!-- custom css file link -->

    <link rel="stylesheet" href="CSS/style.css">

</head>
<body>

<!-- header session start  -->
<?php
include 'components/user_header.php';
?>
<!-- haeder session end -->

<!-- home session start -->

<section class="home">
    <div class="swiper home-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide">
                <div class="content">
                    <span>Book Online</span>
                    <h3>All Types Of Cars</h3>
                    <a href="cars.php" class="btn"> See Cars</a>
                </div>
                <div class="image">
                    <img src="Images/All_TypesOf_Car.png" alt="">
                </div>
            </div>
            <div class="swiper-slide slide">
                <div class="content">
                    <span>Book Online</span>
                    <h3>Low End Types Of Car</h3>
                    <a href="cars.php" class="btn"> See Cars</a>
                </div>
                <div class="image">
                    <img src="Images/low_end_type.png" alt="">
                </div>
            </div>
            <div class="swiper-slide slide">
                <div class="content">
                    <span>Book Online</span>
                    <h3>High End Types Of Car</h3>
                    <a href="cars.php" class="btn"> See Cars</a>
                </div>
                <div class="image">
                    <img src="Images/high_end_type.png" alt="">
                </div>
            </div>
            <div class="swiper-slide slide">
                <div class="content">
                    <span>Book Online</span>
                    <h3>All Types Of Cars</h3>
                    <a href="cars.php" class="btn"> See Cars</a>
                </div>
                <div class="image">
                    <img src="Images/Car.png" alt="">
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- home session ends -->

<!-- home category Section start -->
<section class="home-category">
    <h1 class="title">Cars Category</h1>
    <div class="box-container">
        <a href="category.php?category=Low end type" class="box">
            <img src="Images/Car_low.png" alt="">
            <h3>Low End Type</h3>
        </a>
        <a href="category.php?category=Budget Friendly" class="box">
            <img src="Images/Budget_Friendly.png" alt="">
            <h3>Budget Friendly</h3>
        </a>
        <a href="category.php?category=Budget High end type" class="box">
            <img src="Images/Budget_High.png" alt="">
            <h3>Budget High End Type</h3>
        </a>
        <a href="category.php?category=High end type" class="box">
            <img src="Images/High.png" alt="">
            <h3>High End Type</h3>
        </a>
    </div>
</section>
<!-- home category section ends -->

<!-- Home Products section start -->
<section class="vehicle">
    <h1 class="title">Latest Cars</h1>
    <div class="box-container">
        <?php
           $select_vehicle = $conn->prepare("SELECT * FROM `vehicle` LIMIT 6");
           $select_vehicle->execute();
           if($select_vehicle->rowCount() > 0){
            while($fetch_vehicle = $select_vehicle->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="post" class="box">
            <input type="hidden" name="vid" value="<?= $fetch_vehicle['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_vehicle['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_vehicle['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_vehicle['image']; ?>">
            <a href="quick_view.php?vid=<?= $fetch_vehicle['id']; ?>" class="fas fa-eye"></a>
            <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
            <img src="img/<?= $fetch_vehicle['image']; ?>" alt="">
            <a href="category.php?category=<?= $fetch_vehicle['category']; ?>" class="cat"><?= $fetch_vehicle['category']; ?></a>
            <div class="name"><?= $fetch_vehicle['name']; ?></div>
            <div class="flex">
                <div class="price"><span>$</span><?= $fetch_vehicle['price']; ?><span>/Per day</span></div>
                <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
            </div>
        </form>
        <?php
        }
            }else{
                echo '<p class="empty"> no vehicle added yet!</p>';
            }
        ?>
    </div>
    <div class="more-btn">
        <a href="car.php" class="btn">Load More</a>
    </div>
</section>
<!-- home Product Section Ends -->











<!-- footer section start -->
<?php 
include 'components/footer.php';
?>
<!-- footer section end -->

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>


<!-- custom javascript file link -->
<script src="js/script.js"></script>

<script>
    var swiper = new Swiper(".home-slider", {
        effect: "flip",
        grabCursor: true,
        loop: true,
        pagination: {
            clickable: true,
            el: ".swiper-pagination",
        },
    });
</script>
    
</body>
</html>