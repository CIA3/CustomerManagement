<html>
<head><title>Home page</title>

	<link rel = "stylesheet"  href = "../css/Reg_style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<link rel = "stylesheet"  href = "../css/homes.css">
	
	<style type = "text/css">
		#interface{
			background-color:#333;
			padding:30px;
			margin-top:10px;
			
		}
		
		#interface label, h2{
			color:white;
		}

	</style>
	
</head>

<?php
	session_start();
	include("config.php");

	$userName= $_SESSION['user'];

	$sql = "select * from users where userName = '$userName'";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) 
		{
			$userName =  $row["userName"];
			$name =  $row["fullName"];
			$email =  $row["email"];
			$gender =  $row["gender"];
			$image =  $row["image"];
			$role =  $row["role"];
		}
	}
	
	if(isset ($_POST['bt1'])){
		$_SESSION["user"] = $userName;
		echo "<script type='text/javascript'>window.location.href = 'editUser.php';</script>";
	}

?>
<body>
	<?php include('headerNavigation.php'); ?>
	<div class = "container  text-center">
	<form method = "post">
			<div class = "row">
				<div class = "col-lg-3"></div>
				<div class = "col-lg-6">
				<h4>Welcome <?php echo $userName ?></h4>
				<div id = "interface">
				<img src = "../images/<?php echo $image ?>" style = "width:250px; height:250px;border-radius:90%;"class = "card-img-top"><br><br>
				<label>Name : <?php echo $name ?></label><br>
				<label>Email : <?php echo $email ?></label><br>
				<label>Gender : <?php echo $gender ?></label><br>
				<label>User role : <?php echo $role ?></label>
				<button name = "bt1" class = "btn btn-primary btn-block">Edit </button>
					</div>
				</div>
				<div class = "col-lg-3"></div>
			</div>
	</form>
	</div>
</body>
</html>

