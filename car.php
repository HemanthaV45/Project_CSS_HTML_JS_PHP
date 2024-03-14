<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars</title>

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
    <h3>Our Cars</h3>
    <p>Cars / <a href="home.php">home</a> <span></span></p>
</div>

<!-- menu starts section -->
<section class="vehicle">
    <h1 class="title">All Cars</h1>
    <div class="box-container">
        <?php
           $select_vehicle = $conn->prepare("SELECT * FROM `vehicle`");
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
                <div class="price"><span>₹</span><?= $fetch_vehicle['price']; ?><span>/Per hour</span></div>
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
</section>
<!-- menu ends section -->

<!-- footer starts -->

<?php include 'components/footer.php'; ?>

<!-- footer ends -->
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>