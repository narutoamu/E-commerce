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
	   </span>
	    </div>
		
      <div id= "product_box">
       <form action="" method="post" enctype="multipart/form-data">
	   <table align="center" width="700" bgcolor="skyblue">
	   
			   <tr align="center">
			   <th>Remove</th>
			   <th>Product(s)</th>
			   <th>Quantity</th>
			   <th>Total price</th>
			   </tr>
			   <?php
			      $total=0;
	global $con;
	$ip=getIp();
	$sel_price="select * from cart where ip_add='$ip'";
	$run_price=mysqli_query($con,$sel_price);
	while($p_price=mysqli_fetch_array($run_price))
	{
		$pro_id=$p_price['p_id'];
		$pro_price="select * from products where product_id='$pro_id' ";
		$run_pro_price=mysqli_query($con,$pro_price);
		while($pp_price=mysqli_fetch_array($run_pro_price))
	    {
			$product_price=array($pp_price['product_price']);
			$product_title=$pp_price['product_title'];
			$product_image=$pp_price['product_image'];
			$single_price=$pp_price['product_price'];
			$values=array_sum($product_price);
			$total+=$values;
			?>
			   <tr align="center">
			   
			   <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"/></td>
			   
			   <td><?php echo $product_title;  ?>
			   <br>
			   <img src="admin_area/product_images/<?php echo $product_image; ?>" width="60">
			   </td>
			   <td><input type="text" size="4" name="qty"/></td>
			   <td><?php echo "$".$single_price; ?>
			   </td>
			   </tr>
	             
	<?php
		} 
	}
	?> <tr align="center" colspan="4" ><td><b>Sub Total:</b></td>
				  <td><?php echo "$".$total;?></td>
	           
	</tr>
	<tr align="center">
	   <td colspan="2"><input type="submit" name="update_cart" value="update_cart"/></td>
	   <td><input type="submit" name="continue" value="Continue Shopping"/></td>
	   
     <td><button><a href="checkout.php" style="text-decoration:none color:black;" >CheckOut</a></button></td>
	</tr>
	   </table>
	   </form>
	   <?php
	   global $con;
	   $ip=getIp();
	   if(isset($_POST['update_cart']))
	   {
		   foreach($_POST['remove'] as $remove_id)
		   {
			   $delete_product="delete from cart where p_id='$remove_id' AND ip_add='$ip'";
			   $run_delete=mysqli_query($con,$delete_product);
			   if($run_delete)
			   {
				   echo "<script>window.open('cart.php'.'_self')</script>";
			   }
		   }
	   }
	   
	   ?>
      </div>
      </div>
     
      <div id="footer"> <h2 style="text-align:center; padding-top:30px">&copy; 214 by www.OnlineTuting.com</h2>
     </div>
	  </div>
	 
  
   </div>

</body>
</html>