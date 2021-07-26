<html>
<head><title>Admin home page</title>

	<link rel = "stylesheet"  href = "../css/Reg_style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	
	<style type = "text/css">
		#interior{
			background-color:#333;
			padding:30px;
			margin-top:10px;
			
		}
		
		#interior label, h2{
			color:white;
		}

	</style>
	
</head>

<?php
	session_start();
	include("config.php");

	$userName= $_SESSION['user'];
	$role1 = "Customer";
	$sql = "select * from users where userName = '$userName'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) 
		{
			$userName =  $row["userName"];
		
		}
	}

	$fetchQuery = mysqli_query($conn, "select * from users where role = '$role1'") or die ("Could not fetch. " .mysqli_error($conn));
	
	if(isset ($_POST['submit'])){
		$_SESSION["user"] = $_POST['uName1'];;
		echo "<script type='text/javascript'>window.location.href = 'adminEdit.php';</script>";
	}
	
?>
<body>

	
	<?php include('headerNavigation.php'); ?>
	<div class = "container mt-5">
	
	
	<h4 class = "text-center">Welcome <?php echo $userName ?></h4>
	<?php	
			while($row = mysqli_fetch_array($fetchQuery)){
				$userName1 =  $row["userName"];
				$name =  $row["fullName"];
				$email =  $row["email"];
				$gender =  $row["gender"];
				$image =  $row["image"];
				$role =  $row["role"];
	?>
	<div id = "interior">
		<div class = "card">
			<div class = "row">
				<div class = "col-md-4">
					<img src = "../images/<?php echo $image ?>" style = "width:300px; height:200px;" class = "img-fluid">
				</div>
				<div class = "col-md-6">
				<form method = "post" action = "adminHome.php">
					<label class = "card-title mt-3" >User name : <?php echo $userName1 ?></label><br>
					<label>Full name : <?php echo $name ?></label><br>
					<input type = "hidden" name = "uName1" value = "<?php echo $userName1 ?>">
					<label>Email : <?php echo $email ?></label><br>
					<label>Gender : <?php echo $gender ?></label><br>
					<label>User role : <?php echo $role ?></label>
					<input type = "submit" name = "submit" value = "Edit" class = "btn btn-primary btn-block">
					
				</div>
				</form>
			</div>
			
		</div>
	</div>
		<br><br>
	<?php
			}?>
		</div>

</body>
</html>
