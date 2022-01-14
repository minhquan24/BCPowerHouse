<?php
	include_once 'dbh-inc.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Powerhouse Database</title>
</head>
<link rel="stylesheet" href="style.css">
<style>
	table, tr, td, th{
		border: 1px solid black;
		text-align: center;
		border-collapse: collapse;
		font-family: Arial, Helvetica, sans-serif;
		padding: 2px;
	}
	#data {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#data td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#data tr:nth-child(even){background-color: #f2f2f2;}

#data tr:hover {background-color: #ddd;}

#data th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #000080;
  color: white;
}
	* {
            margin: 0;
            padding: 0;
        }
        .imgbox {
            display: grid;
            height: 100%;
        }
        .center-fit {
            max-width: 100%;
            max-height: 135vh;
            margin: auto;
		}
</style>

<body>
<div class="header">
    <div class="inner_header">
      <div class="logo_container">
	    <h1>  The Powerhouse
	      <br> <span>Fitness & Recreation Center</span> </h1>
	      </div>
    	    <ul class="navigation">
        		<a href="index.php"> <li> Home</li> </a>
            	<a href="about.html"> <li> About</li> </a>
          		<a href="manual.html"> <li> Manual</li> </a>
         	    <a href="contact.html"> <li> Contact</li> </a>
         	    <a href="login.php"> <li> login</li> </a>
          	</ul>
      </div>
</div>


<form method="POST">
	<input type="number" name="item_id" placeholder="item ID">
	<input type="text" name="item_name" placeholder="item name">
	<input type="number" name="quantity" placeholder="quantity">
	<input type="number" name="price" placeholder="price">
	<input type="number" name="area_id" placeholder="Area ID">
	<input type="text" name="category" placeholder="Category"><br>
	<input type="submit" name="button" value="ADD">
	<input type="submit" name="button" value="REMOVE">
	<input type="submit" name="button" value="SEARCH">
	<input type="submit" name="button" value="SHOW ALL">
	<br><br>
</form>


<?php

	//comments work like java
	function searchItems($conn){
		$item_id = $_POST['item_id'];
		$item_name = $_POST['item_name'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$area_id = $_POST['area_id'];
		$category = $_POST['category'];
		if ($item_id == ''){
			$item_id = "NULL";
		}
		if ($item_name == ''){
			$item_name = "NULL";
		}else {
			$item_name = "'".$item_name."'";
		}
		if ($quantity == ''){
			$quantity = "NULL";
		}
		if ($price == ''){
			$price = "NULL";
		}
		if ($area_id == ''){
			$area_id = "NULL";
		}
		if ($category == ''){
			$category = "NULL";
		}else {
			$category = "'".$category."'";
		}
		$sql = "SELECT * FROM items WHERE item_id=$item_id OR item_name=$item_name OR quantity>=$quantity OR price>=$price OR area_id=$area_id OR category=$category;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck > 0){
			echo "<table id='data'><tr><th>Item ID</th><th>Item Name</th><th>Quantity</th><th>Price ($/unit)</th><th>Area ID</th><th>Category</th></tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr><td>".$row['item_id']."</td><td>".$row['item_name']."</td><td>".$row['quantity']."</td><td>".$row['price']."</td><td>".$row['area_id']."</td><td>".$row['category']."</td></tr>";
			}
		}
	}

	function addItem($conn){
		$item_id = $_POST['item_id'];
		$item_name = $_POST['item_name'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$area_id = $_POST['area_id'];
		$category = $_POST['category'];
		if ($item_id == ''){
			$item_id = "NULL";
		}
		if ($item_name == ''){
			$item_name = "NULL";
		}else {
			$item_name = "'".$item_name."'";
		}
		if ($quantity == ''){
			$quantity = "NULL";
		}
		if ($price == ''){
			$price = "NULL";
		}
		if ($area_id == ''){
			$area_id = "NULL";
		}
		if ($category == ''){
			$category = "NULL";
		}else {
			$category = "'".$category."'";
		}
		$sql = "INSERT INTO items VALUE($item_id, $item_name, $quantity, $price, $area_id, $category);";
		$result = mysqli_query($conn, $sql);
		showALL($conn);
	}

	function removeItem($conn){
		$item_id = $_POST['item_id'];
		$item_name = $_POST['item_name'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		$area_id = $_POST['area_id'];
		$category = $_POST['category'];
		if ($item_id == ''){
			$item_id = "NULL";
		}
		if ($item_name == ''){
			$item_name = "NULL";
		}else {
			$item_name = "'".$item_name."'";
		}
		if ($quantity == ''){
			$quantity = "NULL";
		}
		if ($price == ''){
			$price = "NULL";
		}
		if ($area_id == ''){
			$area_id = "NULL";
		}
		if ($category == ''){
			$category = "NULL";
		}else {
			$category = "'".$category."'";
		}
		$sql = "DELETE FROM items WHERE item_id=$item_id OR item_name=$item_name OR quantity=$quantity OR price=$price OR area_id=$area_id OR category=$category;";
		$result = mysqli_query($conn, $sql);
		showALL($conn);
	}

	function showAll($conn){
		$sql = "SELECT * FROM items;";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck > 0){
			echo "<table id='data''><tr><th>Item ID</th><th>Item Name</th><th>Quantity</th><th>Price ($/unit)</th><th>Area ID</th><th>Category</th></tr>";
			while($row = mysqli_fetch_assoc($result)){
				echo "<tr><td>".$row['item_id']."</td><td>".$row['item_name']."</td><td>".$row['quantity']."</td><td>".$row['price']."</td><td>".$row['area_id']."</td><td>".$row['category']."</td></tr>";
			}
		}
	}
	if (isset($_POST['button'])){
		switch ($_POST['button']){
			case 'ADD':
				addItem($conn);
			break;
			case 'REMOVE':
				removeItem($conn);
			break;
			case 'SEARCH':
				searchItems($conn);
			break;
			case 'SHOW ALL':
				showALL($conn);
			break;
		}
	}
	else showALL($conn);
	
?>

</body>
</html>