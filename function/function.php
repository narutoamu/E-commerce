 <?php
 $con= mysqli_connect("Localhost","root","","ecommerce");
 
 function getIp()
 {
	  $ip=$_SERVER['REMOTE_ADDR'];
	  if(!empty($_SERVER['HTTP_CLIENT_IP']))
	  { $ip=$_SERVER['HTTP_CLIENT_IP'];}
  elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
	  $ip=$_SERVER['HTTP_x_FORWARDED_FOR'];
	  	  
  }
  return $ip;
 }
function cart()
{
	global $con;
	if(isset($_GET['add_cart']))
	{$ip=getIp();
	$pro_id=$_GET['add_cart'];
	$check_pro="select * from cart where ip_add='$ip' AND p_id=' $pro_id'";
	$run_check=mysqli_query($con,$check_pro);
	
          	 
		 $insert_pro="insert into cart(p_id,ip_add) values ('$pro_id','$ip')";
		
	 $run_pro=mysqli_query($con,$insert_pro);
	 if($run_pro)
	 {echo "<script>window.open('index.php','_self')</script>";
	   
	 }
	 
}
}
function total_items()
{
	if(isset($_GET['add_cart']))
	{global $con;
	    $ip=getIp();
		$get_items="select * from cart where ip_add='$ip'";
		$run_items=mysqli_query($con,$get_items);
		$count_items=mysqli_num_rows($run_items);
		
	}
	else
		
	{
		global $con;
		$ip=getIp();
		$get_items="select * from cart where ip_add='$ip'";
		$run_items=mysqli_query($con,$get_items);
		$count_items=mysqli_num_rows($run_items);
	}
	echo $count_items;
} 
function total_price()
{
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
			$values=array_sum($product_price);
		   $total+=$values;	
		}		
	} 
   
echo "$".$total;   
 }
 
 function getCats()
 {
	  global $con;
    $get_brands="select * from categories";
	$run_brands=mysqli_query($con,$get_brands);
	while($row_brands=mysqli_fetch_array($run_brands))
    {
	   $brand_id=$row_brands['cat_id'];
	   $brand_title=$row_brands['cat_title'];
	   echo "<li><a href='index.php?cat=$brand_id'>$brand_title</a></li>";
	   
     }	
 }
 
 function getbrands()
 {
	  global $con;
    $get_brands="select * from brands";
	$run_brands=mysqli_query($con,$get_brands);
	while($row_brands=mysqli_fetch_array($run_brands))
    {
	   $brand_id=$row_brands['brand_id'];
	   $brand_title=$row_brands['brand_title'];
	   echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	   
     }	
 }
 function getPro()
 { 
   if(!isset($_GET['cat']))
   { if(!isset($_GET['brand']))
	   {global $con;
	 $get_pro="select * from products order by RAND() LIMIT 0,6";
	 $run_pro=mysqli_query($con,$get_pro);
	 while($row_pro = mysqli_fetch_array($run_pro))
	 {
		$pro_id=$row_pro['product_id'];
		$pro_cat=$row_pro['product_cat'];
		$pro_brand=$row_pro['product_brand'];
		$pro_title=$row_pro['product_title'];
		$pro_price=$row_pro['product_price'];
		$pro_image=$row_pro['product_image'];
	   
	   
	   echo "<div id='single_product'>
	   <h2>$pro_title</h2>
	   <img src='admin_area/product_images/$pro_image' height='200' width='240'/>
	   <p><b>$pro_price </b></p>
	   <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
	   <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart </a >
	   </div>";
	   
	 } 
		 
   }} 
	 
 }	
 function getCatPro()
 { 
	if(isset($_GET['cat']))
	{$cat_id=$_GET['cat']; 	  
	 global $con;
	 $get_cat_pro="select * from products where product_cat='$cat_id'" ;
	 
	 $run_pro=mysqli_query($con,$get_cat_pro);
	 
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
	   <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart </a >
	   </div>";
	   
	 } 
	 if($count==0)
		 echo "<h2>There is no product tn this Category !</h2> ";
		 }
 }
 function getBrandPro()
 { 
 
  if(isset($_GET['brand']))
  {$brand_id=$_GET['brand']; 	  
	 global $con;
	 $get_pro="select * from products where product_brand='$brand_id'" ;
	 $count=0;
	 $run_pro=mysqli_query($con,$get_pro);
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
	   <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart </a >
	   </div>";
	   
	 }
	 
	 if($count==0)
		 echo "<h2>There is no product tn this Brand !</h2> ";	 
  }
	 
 }	
 
 
 ?>
 












