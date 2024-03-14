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
    <title>Category</title>

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

<!-- category section starts -->
<section class="vehicle">
    <h1 class="title">Vehicle Category</h1>
    <div class="box-container">
        <?php
           $category=$_GET['category'];
           $select_vehicle = $conn->prepare("SELECT * FROM `vehicle` WHERE category = ?");
           $select_vehicle->execute([$category]);
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
</section>

<!-- category section ends -->


<!-- footer section start -->
<?php 
include 'components/footer.php';
?>
<!-- footer section end -->

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>


<!-- custom javascript file link -->
<script src="js/script.js"></script>
</body>
</html>