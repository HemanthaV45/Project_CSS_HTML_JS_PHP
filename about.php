<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
    <h3>about us</h3>
    <p><a href="home.php">home</a> <span> / about</span></p>
</div>

<!-- About section starts -->

<section class="about">
    <div class="row">
    <p>VHSV Renta Car has a new face. After more than 20 years in business, we decided to give a fresher look to our brand and our services. With our fully renewed fleet of vehicles, we are ready to meet all expectations and requirements.</p>
        <div class="image">
            <img src="Images/about.png" alt="">
        </div>
        <div class="content">
            <h3>Why Choose Us?</h3>
            <p>
            -  If you want to book directly through a supplier, and not through a broker choose VHSV Rent A Car<br>
            -  this will give you better flexibility in terms of vehicle choices;<br>
            -  vehicle make and model will be confirmed, and not “similar” to those you selected;<br>
            -  you can directly negotiate some of the terms and conditions, payment options, especially if you require unique or long term rental service;<br>
            -  you can book “commission free”;<br>
            </p>
            <a href="car.php" class="btn"> Our Cars </a>
        </div>
    </div>
</section>

<!-- About section ends -->

<!-- review section starts -->

<section class="reviews">
    <h1 class="title"> Customer's Reviews</h1>
    <div class="swiper reviews-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide slide">
                <img src="Images/person.png" alt="">
                <p>The company itself is a very successful company. Who choose the pleasures of their labors, so that there are none of them in the labor of pleasures.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>
            <div class="swiper-slide slide">
                <img src="Images/person1.png" alt="">
                <p>The company itself is a very successful company. Who choose the pleasures of their labors, so that there are none of them in the labor of pleasures.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h3>john deo</h3>
            </div>
            <div class="swiper-slide slide">
                <img src="Images/person2.png" alt="">
                <p>The company itself is a very successful company. Who choose the pleasures of their labors, so that there are none of them in the labor of pleasures.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>
            <div class="swiper-slide slide">
                <img src="Images/person3.png" alt="">
                <p>The company itself is a very successful company. Who choose the pleasures of their labors, so that there are none of them in the labor of pleasures.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>
            <div class="swiper-slide slide">
                <img src="Images/person4.png" alt="">
                <p>The company itself is a very successful company. Who choose the pleasures of their labors, so that there are none of them in the labor of pleasures.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<!-- review section ends -->

<!-- footer starts -->

<?php include 'components/footer.php'; ?>

<!-- footer ends -->

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>
    var swiper = new Swiper(".reviews-slider", {
        grabCursor: true,
        loop: true,
        spaceBetween: 20,
        pagination: {
            clickable: true,
            el: ".swiper-pagination",
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
</script>
    
</body>
</html>