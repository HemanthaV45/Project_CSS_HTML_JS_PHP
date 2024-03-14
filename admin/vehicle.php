<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_vehicle'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../img/'.$image;

   $select_vehicle = $conn->prepare("SELECT * FROM `vehicle` WHERE name = ?");
   $select_vehicle->execute([$name]);

   if($select_vehicle->rowCount() > 0){
      $message[] = 'vehicle name already exists!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_vehicle = $conn->prepare("INSERT INTO `vehicle`(name, category, price, image) VALUES(?,?,?,?)");
         $insert_vehicle->execute([$name, $category, $price, $image]);

         $message[] = 'new vehicle added!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_vehicle_image = $conn->prepare("SELECT * FROM `vehicle` WHERE id = ?");
   $delete_vehicle_image->execute([$delete_id]);
   $fetch_delete_image = $delete_vehicle_image->fetch(PDO::FETCH_ASSOC);
   unlink('../img/'.$fetch_delete_image['image']);
   $delete_vehicle = $conn->prepare("DELETE FROM `vehicle` WHERE id = ?");
   $delete_vehicle->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE vid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:vehicle.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>vehicle</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../CSS/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add products section starts  -->

<section class="add-vehicle">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add vehicle</h3>
      <input type="text" required placeholder="enter vehicle name" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="enter vehicle price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>select category --</option>
         <option value="low end type">Low End Type</option>
         <option value="Budget Friendly">Budget Friendly</option>
         <option value="Budget High end type">Budget High end type</option>
         <option value="High end type">High End Type</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp, image/png" required>
      <input type="submit" value="add vehicle" name="add_vehicle" class="btn">
   </form>

</section>

<!-- add products section ends -->

<!-- show products section starts  -->

<section class="show-vehicle" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_vehicle = $conn->prepare("SELECT * FROM `vehicle`");
      $show_vehicle->execute();
      if($show_vehicle->rowCount() > 0){
         while($fetch_vehicle = $show_vehicle->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../img/<?= $fetch_vehicle['image']; ?>" alt="">
      <div class="flex">
         <div class="price"><span>₹</span><?= $fetch_vehicle['price']; ?><span>/-</span></div>
         <div class="category"><?= $fetch_vehicle['category']; ?></div>
      </div>
      <div class="name"><?= $fetch_vehicle['name']; ?></div>
      <div class="flex-btn">
         <a href="update_vehicle.php?update=<?= $fetch_vehicle['id']; ?>" class="option-btn">update</a>
         <a href="vehicle.php?delete=<?= $fetch_vehicle['id']; ?>" class="delete-btn" onclick="return confirm('delete this vehicle?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no vehicle added yet!</p>';
      }
   ?>

   </div>

</section>

<!-- show products section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>