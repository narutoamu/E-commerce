<!doctype>
<?php
session_start();
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
		<form action="customer_register.php" method="post" enctype="multipart/form-data" >
		<table align="center" width="750">
		<tr>
		  <td><h1>Create an Acount</h1></td>
		  </tr>
		  <tr>
		   <td align="right">Customer Name:</td>
		   <td><input type="text" name="c_name" required/></td>
		     </tr>
		  <tr>
		<td align="right">Customer Email</td>
		<td><input type="text" name="c_email" required/></td> </tr>
		  <tr>
		<td align="right">Customer Password</td>
		<td><input type="password" name="c_pass" required/></td> </tr>  
		<tr>
		  <tr>
		<td align="right">Customer Image</td>
		<td><input type="file" name="c_image" required/></td> </tr>  
		<tr>
		<td align="right">Customer country</td>
		<td><select name="c_country">
		<option>Select a country</option>
		<option>Afganistan</option>
		<option>India</option>
		<option>Japan</option>
		<option>Pakistan</option>
		<option>Israel</option>
		<option>Nepal</option>
		<option>United Arb Emirates</option>
		<option>United states</option>
		<option>United kingdom</option>
		</select>
		</td></tr>
		  <tr>
		<td align="right">Customer City</td>
		<td><input type="text" name="c_city" required/></td> </tr>
		  <tr>
		<td align="right">Customer Contact</td>
		<td><input type="text" name="c_contact" required/></td> </tr>
		  <tr>
		<td align="right">Customer address</td>
		<td><input type="text" name="c_address" required/></td>
 		</tr>
		<tr>
		  <td align="right">  <input type="submit" name="register" value="Create Account"></td>
		</tr>
      </div>
     </table>
	 </form>
     <?php
   if(isset($_POST['register']))
   {
	   global $con;
	   $ip=getIp();
	   $c_name=$_POST['c_name'];
	   $c_email=$_POST['c_email'];
	   $c_pass=$_POST['c_pass'];
	   $c_image=$_FILES['c_image']['name'];
	   $c_image_tmp=$_FILES['c_image']['tmp_name'];
	   $c_country=$_POST['c_country'];
	   $c_city=$_POST['c_city'];
	   $c_contact=$_POST['c_contact'];
	   $c_address=$_POST['c_address'];
	   move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
	 $insert_c="insert into customers (customer_ip,customer_name,customer_email,
	 customer_password,customer_country,customer_city,customer_contact,customer_address,
	 customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city',
	 '$c_contact','$c_address','$c_image')";
 $run_c=mysqli_query($con,$insert_c);
	 $sel_cart="select * from cart where ip_add='$ip'";
	 $run_cart=mysqli_query($con,$sel_cart);
	 $run_check=mysqli_num_rows($run_cart);
	 if($run_check==0)
	 {
		 $_SESSION['customer_email']=$c_email;
		 echo "<script>alert('Account has been created sucessfully,thanks!')</script>";
		 echo "<script>window.open('customer/my_account.php'.'_self')</script>";
	 }
	 else
	 {
		 $_SESSION['customer_email']=$c_email;
		 echo "<script>alert('Account has been created sucessfully,thanks!')</script>";
		 echo "<script>window.open('checkout.php'.'_self')</script>";
		 
	 }
	   
	   
   }

?>
	
	

	 <div id="footer"> <h2 style="text-align:center; padding-top:30px">&copy; 214 by www.OnlineTuting.com</h2>
     </div>
  </div>
    </div>
</body>
</html>
