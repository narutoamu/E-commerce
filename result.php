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
      <div id="shopping_cart">
	  <span style="float:right; font-size:18px; padding:5px line-height:40px;" align="center">Welcome Guest! <b style="color:yellow">Shopping cart-</b>
	    Total Price: Total Item:<a href="cart.php" style="color:yellow">Go to cart</a>
	   </span>
	    </div>
		 
      <div id= "product_box">
      <?php 
	  if(isset($_GET['search'])){
     $search_query=$_GET['user_query'];	 
	 global $con;
	 $get_all_pro="select * from products where product_keywords like '%$search_query%'"  ;
	 
	 $run_pro=mysqli_query($con,$get_all_pro);
	 
	 $count=0;
	 while($row_pro = mysqli_fetch_array($run_pro))
	 {
		$pro_id=$row_pro['product_id'];
		$pro_cat=$row_pro['product_cat'];
		$pro_brand=$row_pro['product_brand'];
		$pro_title=$row_pro['product_title'];
		$pro_price=$row_pro['product_price'];
		$pro_image=$row_pro['product_image'];
$count++;
	   
	   echo "<div id='single_product'>
	   <h2>$pro_title</h2>
	   <img src='admin_area/product_images/$pro_image' height='200' width='240'/> 
	   <p><b>$pro_price </b></p>
	   <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
	   <a href='index.php?pro_id=$pro_id'><button style='float:right;'>Add to cart </a >
	   </div>";
	   
	 } 
	  }
	 if($count==0)
		 echo "<h2>no such product available!</h2> ";
		 
	 
	  
	  ?>
      </div>
      </div>
     
      <div id="footer"> <h2 style="text-align:center; padding-top:30px">&copy; 214 by www.OnlineTuting.com</h2>
     </div>
	  </div>
	 
  
   </div>

</body>
</html>