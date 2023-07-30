<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>


    <link rel="icon" href="favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
      integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/app.css">
 
  </head>

  <body>
    
    <!-- Navigation -->
    <header class="page-header">
      <a href="#" class="brand"><i class="fas fa-shopping-cart"></i>Shopaholic</a>
      <input type="checkbox" id="toggler-btn">
      <label for="toggler-btn"><i class="fas fa-bars"></i></label>
      <nav class="navbar">
        <a href="/">Home</a>
        <a href="/shop">Shop</a>
        <a href="/contact">Contact</a>
        <a href="/about">About</a>
      </nav>

      <div class="toolbar">
        <a href="#"><i class="far fa-heart"></i><small class="text-gray">(<span id="total-number-items-in-wishlist">0</span>)</small></a>
        <a href="cart.html"><i class="fas fa-dolly-flatbed"></i><small class="text-gray">(<span id="total-number-items-in-cart">0</span>)</small></a>
        <a onclick="window.login.showModal();"><i class="far fa-user"></i></a>
      </div>
    </header>
    <!-- /Navigation -->
    {{ content }}
    <!-- footer component -->
    <footer-component></footer-component>   
    <!-- /footer -->

    <div class="modal-window" style="display: block;"></div>
    <dialog id="login">
      <form action="" class="login-form">
        <h3>sign in</h3>
        <input type="email" name="" placeholder="enter your email" id="" class="box form-control">
        <input type="password" name="" placeholder="enter your password" id="" class="box form-control">
        <div class="remember form-check">
            <input type="checkbox" name="" id="remember-me" class="form-check-input">
            <label for="remember-me">remember me</label>
        </div>
        <input type="submit" value="sign in" class="btn btn-primary">
        <div class="links">
            <a href="#">forget password</a>
            <a href="#">sign up</a>
            <a href="#" onclick="window.login.close();">Close</a>
        </div>
      </form>
    </dialog>

    <!-- <script src="js/db.js"></script> -->
    <!-- <script src="js/components/carousel.js"></script> -->
    <script src="js/components/footer.js"></script>
    <!-- <script src="js/app.js"></script> -->
  </body>

</html>
