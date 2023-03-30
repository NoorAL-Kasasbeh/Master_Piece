<?php
//  connect on db
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
   <title>contact</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- header section starts  -->  
<?php include 'components/user_header.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="img/contact.png" alt="imشge-contact">
      </div>

      <div class="content">
         <h3>Contact Us</h3>
         <p class="p1"><br>Dear customer, If you have any questions, please send them our way!  We love hearing from everyone. 
              we are happy to serve you.<br><br>
              We hope to be exelent as you think and give you the best.
              If you are interested and have a disabled child, send his creative work and information to the Marketing department, We will respond back to you as soon as possible.</p>
           </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">We're here to help</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="images/pp1.png" alt="">
         <h3>Sales</h3>
         <p>If there are problems related to the sales department, please contact us by email.
We will respond back to you as soon as possible.<br>
<b>Salesdepartment@gmail.com</b></p>
      
       
      </div>

      <div class="swiper-slide slide">
         <img src="images/pp2.png" alt="">
         <h3>Complaints</h3>
         <p>If there are complaints, please contact us by email. We are happy to serve you.
We will respond back to you as soon as possible.
<b>Complaints@gmail.com</b></p>
         
         
      </div>

      <div class="swiper-slide slide">
         <img src="images/pp3.png" alt="">
         <h3>Marketing</h3>
         <p>If  have talent or have creative artistic handicrafts, please contact to marketing by email.
We will respond back to you as soon as possible.
<b>Marketing@gmail.com</b></p>
         
         
      </div>

   </div>

</section>



<!-- footer section start -->
<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:false,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>