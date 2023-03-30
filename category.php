<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addTOcart'])){
   $product_id = $_POST['product_id'];
   $product_name = $_POST['name'];
   $product_price = $_POST['price'];
   $product_image = $_POST['image'];
   $product_quantity = $_POST['quantity'];

   $check_product_id = $conn->prepare("SELECT product_id FROM `cart` WHERE user_id = '$user_id'");
   $check_product_id->execute();
   

   $flag = true;

   while($fetch_product = $check_product_id->fetch(PDO::FETCH_ASSOC)){
      if (in_array($product_id, $fetch_product)){
         $flag = false;
         break;
      }
   };
   if($flag==true){
      if($user_id > 0){
      $send_to_cart = $conn->prepare("INSERT INTO `cart` (user_id , product_id , name , price , image , quantity)
                                    VALUES (? , ? , ? , ?, ? , ?)"); 
      $send_to_cart->execute([$user_id , $product_id , $product_name , $product_price, $product_image, $product_quantity]);

   }else {
      $array_cart = [$product_id , $product_name , $product_price, $product_image, $product_quantity];
      array_push($_SESSION['cart'], $array_cart);
      // echo'<pre>';
      // print_r($_SESSION['cart']);
      // echo'</pre>';
   }
}
}




if(isset($_POST['add_to_wishlist'])){

   if($user_id == ''){

      $flag = true;
      $pid = $_POST['product_id'];

      foreach($_SESSION['fav'] as $id){
         if (in_array($pid,$id)){
            $flag = false;
            break;
         }
      };
      if($flag==true){
         $array_fav = [$pid];
         array_push($_SESSION['fav'], $array_fav);
         // echo'<pre>';
         // print_r($_SESSION['fav']);
         // echo'</pre>';
      }

   }else{

      $pid = $_POST['product_id'];


      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `favorite` WHERE product_id = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$pid, $user_id]);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE product_id = ? AND user_id = ?");
      $check_cart_numbers->execute([$pid, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $message[] = 'Your Product <span style="color:red">Already</span> Added To Wishlist!';
      }elseif($check_cart_numbers->rowCount() > 0){
         $message[] = 'Your Product <span style="color:red">Already</span> Added To Cart!';
      }else{
         $insert_wishlist = $conn->prepare("INSERT INTO `favorite`(user_id, product_id) VALUES(?,?)");
         $insert_wishlist->execute([$user_id, $pid]);
         $message[] = 'Your Product <span style="color:green">Added</span> To Wishlist!';
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
   <title>shop</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="icon" type="image/x-icon" href="./images/logo.png">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css"> 

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="products">
   <?php
   $category = $_GET['category'];
   $name_of_category = $conn->prepare("SELECT * FROM `category` WHERE category_id = '$category' "); 
   $name_of_category->execute();
   $fetch_category_name = $name_of_category->fetch(PDO::FETCH_ASSOC);
   ?>
   <h1 class="heading">Category : <?= $fetch_category_name['category_name']; ?> </h1>

   <div class="box-container">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE category_id = '$category'"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         $i=0;
         $is_product_in_store = ($fetch_product['store']-$fetch_product['sold']);
         if ( $is_product_in_store <= 0 ){
            continue;
         } else { ?>
         <form action="" method="post" class="box" style="height:430px">
            <input type="hidden" name="product_id" value="<?= $fetch_product['product_id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
            <?php 
            if ($fetch_product['is_sale'] == 1){
               ?>
               <input type="hidden" name="price" value="<?=$fetch_product['price_discount'];?>">
               <?php
            } else {
               ?>
               <input type="hidden" name="price" value="<?=$fetch_product['price'];?>">
               <?php
            }
            ?>
            <input type="hidden" name="image" value="<?= $fetch_product['image']; ?>">
            <a href="quick_view.php?pid=<?= $fetch_product['product_id']; ?>" class="fas fa-eye"></a>
            <img src="uploaded_img/<?= $fetch_product['image']; ?>" alt="">
            <div class="name"><?= $fetch_product['name']; ?></div>
            <?php $product_category = $conn->prepare("SELECT * 
                                             FROM `products`
                                             INNER JOIN `category` ON products.category_id = category.category_id");
                        $product_category->execute();
                        if($product_category->rowCount() > 0){
                           while($fetch_product_category = $product_category->fetch(PDO::FETCH_ASSOC)){ 
                              if($i==0 && $fetch_product['category_id'] == $fetch_product_category['category_id'] ){
                              $i++;
                  ?>
                              <div class="details" style="color : rgb(133, 132, 132); font-size:15px"><span>Category : <?= $fetch_product_category['category_name']; ?></span>
            </div>
                  <?php } } } ?>
            <div class="flex">

               <?php if ($fetch_product['is_sale'] == 1){ ?>

                  <div class="price" style="padding:7px 0px"><span><del style="text-decoration:line-through; color:silver">$<?= $fetch_product['price']; ?></del><ins style="color:#67022f;"> $<?=$fetch_product['price_discount'];?></ins> </span></div>

               <?php } else { ?>

                  <div class="name" style="color:#67022f; padding:20px 0px">$<?= $fetch_product['price']; ?></div> <?php } ?>

               <?php if (($fetch_product['store']-$fetch_product['sold']) != '1'){?>

                  <input style="margin-left: 160px ;" type="number" name="quantity" class="qty" min="1" max="<?= $fetch_product['store']-$fetch_product['sold'];?>" value="1">

               <?php } else { ?>
                  <input type="hidden" name="quantity" value="1">
               <?php } ?> 

            </div>
            <button type="submit" class="btn" name="addTOcart">Add To Cart</button>
         </form>
         <?php
         } } } else { echo '<p class="empty">no products found!</p>'; } ?>

   </div>

</section>


<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>