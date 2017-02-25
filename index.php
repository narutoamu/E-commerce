<!doctype>
<?php
include("function/function.php");
?>

<html>
  <head>
  <title>the shopping Online 
  </title>
  <link rel="stylesheet" href="styles/style.css" media="all"/>
  </head>
  

<body>
  <div class="main_wrapper" >
     <div class="header_wrapper">
      <img id="logo" src="images/shop_logo.png"/>
      <img id="banner" src="images/add_banner.png"/>
     </div>
     <div class="menubar">
      <ul id="menu">
      <li><a href="index.php">Home</li>
      <li><a href="all_products.php">All products</li>
      <li><a href="customer/my_account.php">My Acount</li>
      <li><a href="#">Sign up</li>
      <li><a href="cart.php">Shopping cart</li>
      <li><a href="#">contact us </li>
      </ul>
     <div id="form">
      <form method="get" action="result.php" enctype="multipart/form-data">
	  <input type="text" name="user_query" placeholder="search a product" align="center" />
	 
	  <input type="submit" name="search" value="search"/>
      </form>
     </div>
	 <?php 
	 
	 ?>
     </div>
    <div class="content_wrapper"> 
  
      <div id="sidebar">
        <div id="sidebar_title">Categories</div>
         <ul id="cats">
         <?php getcats(); 
         ?>
         </ul>
      <div id="sidebar_title">Brands</div>
         <ul id="cats">
         <?php getbrands();
          ?>
         </ul>
      </div>
   
      <div id="content_area">
	  <?php  cart(); ?>
      <div id="shopping_cart">
	  <span style="float:right; font-size:18px; padding:5px line-height:40px;" align="center">Welcome Guest! <b style="color:yellow">Shopping cart-</b>
	    Total Price: <?php total_price() ?>  Total Item: <?php total_items() ?>  <a href="cart.php" style="color:yellow">Go to cart</a>
	   <?php
        if(!isset($_SESSION['customer_email'])){
			echo "<a href='checkout.php' style='color:white'>Login</a>";
			
		}
		else
		{
			echo "<a href='logout.php'>Logout</a>";
		}

	   ?>
	   </span>
	    </div>
		
      <div id= "product_box">
      <?php getPro();?>
	  <?php getCatPro();?>
	  <?php getBrandPro();?>
      </div>
      </div>
     
      <div id="footer"> <h2 style="text-align:center; padding-top:30px">&copy; 214 by www.OnlineTuting.com</h2>
     </div>
	  </div>
	 
  
   </div>

</body>
</html>