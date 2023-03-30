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
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
 <!-- header section starts  -->
<?php include 'components/user_header.php'; ?>

 <!-- about section start -->
<section class="about">

   <div class="row">

      <div class="image">
         <img src="img/about.jpg" alt="imge-about">
      </div>

      <div class="content">
         <h3>Who We Are?</h3>
         <p style="text-align: justify"><br>In our heart city of Aqaba, The Art Hand Craft Website contributes to a community that is open to differnt people that can develop and use all their talents together.<br><br>
   We are a group of people who have created a website that specializes in selling diffrent art product made by
    hand  through which we display the talents of many people. We hope to also encourage all to discover and develop their 
    own unique artistic crafting skills.  No matter if you are a pro crafter or this is your first piece, remember -- you may not have set
     out to be artist, but life has a way of leading you to your path.</p>
        </div>

   </div>
</section>

   <!-- about reviews start -->
<section class="reviews">
   
   <h1 class="heading">client's reviews</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="img/about1.jpeg" alt="about1">
         <p>"Loving Art Hand Craft! I've got one of the nicest pieces of art. Ease of handle with website.So far I have had no problems with Art Hand Craft website."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Bara'a</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="img/about2.jpeg" alt="about2">
         <p>"I absolutely love the handmade art pieces! They are so beautiful on the wall. They are of high quality. But I prefer online payment, online payment is faster than cash."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Amro</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="img/about3.jpeg" alt="about3">
         <p>"I can't say enough about these beautiful pieces. They are absolutely gorgeous! I recommend them to everyone. I only had them a month ago but I am very impressed with the price-quality!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>obaida</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="img/about4.jpg" alt="about4">
         <p>"I liked the idea of the site, In my opinion handmade products are rare .The product discount at that price so that’s a plus! add to that delivery was real quick "</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Muna</h3>
      </div>

   </div>
  <!-- circle -->
   <div class="swiper-pagination"></div>

   </div>
</section>



   <!-- footer section start -->
<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
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