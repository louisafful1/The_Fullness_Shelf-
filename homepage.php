<?php
include 'session.php';
include "include/database.php";

if(isset($_POST['add-to-cart'])){
  $title = $_POST['title'];
  $author = $_POST['author'];
  $price = $_POST['price'];
  $image =$_POST['image'];
  $quantity = $_POST['quantity'];
  $user_id = $_SESSION['user_id'];




$select_from_cart = mysqli_query($connection, "SELECT * FROM cart where title = '$title' and user_id ='$user_id';");


if(mysqli_num_rows($select_from_cart) > 0){
  echo "<script> alert('You\'ve already added this item to the cart');</script>";

}else{
 $insert = mysqli_query($connection, "INSERT INTO cart VALUES (DEFAULT, '$user_id', '$title','$author', '$quantity','$price', '$image');");
  if($insert){
    echo "<script> alert('You added this item to the cart');</script>";
  }
  
}


}


?>  

<!DOCTYPE html>
<html>
<head>




	<title>The Fullness Shelf</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
     <link rel="stylesheet" href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css'> 

   <style type="text/css">
            body{
  margin-top: 70px;
  /*margin-left: 70px;*/
}
marquee{
  height: 35px;
  color: white;
  margin-bottom: 2px;

}
.products{

}
.main-container{

   display: flex;
   flex-wrap: wrap; /*pulls some divs down*/
   gap:15px;
   justify-content: center;
}

.main-container .display-form{
text-align: center;
border-radius: 5px;
position: relative;
border:1px solid black;
position: relative;
padding: 20px;
width: 340px;

}

img{
  width: 230px;
  height: 48vh;
  margin-top: 5%;
}


.display-container{

/*  width: 340px;
  height:75vh;
  border:1px solid black;
  margin: 15px;
  text-align:   center;
  border-radius: 10px;*/
}

.name{
margin-bottom: 0px;
font-size: 20px;
padding: 5px 0;
}

.discount{
  position: absolute;
  top: 20px;
  left: 20px;
  padding: 5px 10px;
  border-radius: 5px;
  background: orange;
  font-size: 25px;
}
.qty{
  width: 85%;
  height: 40px;
  border:2px solid black;
  border-radius: 8px;
 font-size: 20px;
 text-align: center;
}
.btn{
  margin-top: 5%;
  border: 1px solid blue;
}

button{
 margin-left: 48%;
}

button a{
  text-decoration: none;
  color: white;
}
     </style> 
</head>
<body>
  <!-- navbar -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark id text-white p-2 fluid py-3 fixed-top" id="navbar">
  <div class="container">
 <a class="navbar-brand">The Fullness Shelf</a>

<button 
class="navbar-toggler" 
type="button" 
data-bs-toggle="collapse" 
data-bs-target="#navmenu">
  <span class="navbar-toggler-icon"></span>

</button>

 <div class="collapse navbar-collapse" id="navmenu"> <!-- drop down -->
  <ul class="navbar-nav ms-auto"> <!-- aligns to the right -->
    <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
     <li class="nav-item"><a href="" class="nav-link">About</a></li>
      <li class="nav-item"><a href="shopping.php" class="nav-link">Shop</a></li>
       <li class="nav-item"><a href="inbox.php" class="nav-link">Inbox</a></li>
       <li class="nav-item"><a href="cart.php" class="nav-link">Cart</a></li>
       <div style="color: white; position: relative; right: 8px; font-size: 20px; bottom: 6px;">(<?php echo $_SESSION['count'];?>)</div>
      <li class="nav-item"><a href="" class="nav-link">Contact Us</a></li>
     &nbsp; &nbsp;&nbsp;&nbsp;<a href="logout.php">Logout</a>
  </ul>
   
 </div>
</div>
</nav>

<marquee class="bg-primary"><h4>Christmas Sales - Live Now!</h4></marquee>
<div class="products">
<div class="main-container">
 <?php
include "include/database.php";
$select = mysqli_query($connection, "SELECT * FROM products LIMIT 6");
 
if( mysqli_num_rows($select) >0){
while($fetch = mysqli_fetch_array($select)){
?>

<form method="post" class="display-form" action=""> 
<div class="display-container">
<a href="book-details.php?id=<?php echo $fetch['product_id'];?>"><img src="admin/uploaded_img/<?php echo $fetch['image'];?>"></a>
<div class="name"><?php echo  $fetch['title']; ?></div>S
<div class="price">GH&#x20B5; <?php echo number_format($fetch['unit']); ?>.00</div>
<div class="discount">-<?php echo $fetch['unit']."%"; ?></div>
<input type="number" min="1" name="quantity" class="qty" value="1"><br>
<input type="hidden" name="title" value="<?php echo $fetch['title']; ?>">  
<input type="hidden" name="author" value="<?php echo $fetch['author']; ?>">
<input type="hidden" name="price" value="<?php echo $fetch['unit']; ?>">
<input type="hidden" name="image" value="<?php echo $fetch['image']; ?>">
<input type="submit" name="add-to-cart" class="btn bg-primary" value="Add To Cart">
</div>
</form>



 <?php
}
     }else{
   echo "No Product added yet";

     }

?>
</div>
</div>

   

   <button class="load-more btn bg-warning"><a href="shopping.php">Load More...</a></button>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>