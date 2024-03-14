<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $vid = $_POST['vid'];
   $vid = filter_var($vid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $update_vehicle = $conn->prepare("UPDATE `vehicle` SET name = ?, category = ?, price = ? WHERE id = ?");
   $update_vehicle->execute([$name, $category, $price, $vid]);

   $message[] = 'vehicle updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `vehicle` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $vid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../img/'.$old_image);
         $message[] = 'image updated!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update product</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../CSS/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update product section starts  -->

<section class="update-vehicle">

   <h1 class="heading">update vehicle</h1>

   <?php
      $update_id = $_GET['update'];
      $show_vehicle = $conn->prepare("SELECT * FROM `vehicle` WHERE id = ?");
      $show_vehicle->execute([$update_id]);
      if($show_vehicle->rowCount() > 0){
         while($fetch_vehicle = $show_vehicle->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="vid" value="<?= $fetch_vehicle['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_vehicle['image']; ?>">
      <img src="../uploaded_img/<?= $fetch_vehicle['image']; ?>" alt="">
      <span>update name</span>
      <input type="text" required placeholder="enter vehicle name" name="name" maxlength="100" class="box" value="<?= $fetch_vehicle['name']; ?>">
      <span>update price</span>
      <input type="number" min="0" max="9999999999" required placeholder="enter vehicle price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_vehicle['price']; ?>">
      <span>update category</span>
      <select name="category" class="box" required>
         <option selected value="<?= $fetch_vehicle['category']; ?>"><?= $fetch_vehicle['category']; ?></option>
         <option value="Low End Type">Low End Type</option>
         <option value="Budget Friendly">Budget Friendly</option>
         <option value="Budget High end type">Budget High end type</option>
         <option value="High end type">High end type</option>
      </select>
      <span>update image</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp, image/png">
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="vehicle.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no vehicle added yet!</p>';
      }
   ?>

</section>

<!-- update product section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>