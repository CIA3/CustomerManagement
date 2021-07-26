<html>
<head><title>Register page</title>

	<link rel = "stylesheet"  href = "../css/Reg_style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<script src = "../js/reg.js"></script>
	
	<style type = "text/css">
		#interface{
			background-color:#333;
			padding:30px;
			margin-top:10px;
			
		}
		
		#interface label, h2{
			color:white;
		}
		
		.upload{
			background:white;
			border-radius:50px;
			outline:none;
			
		}
	

		::-webkit-file-upload-button{
			color:white;
			background:#206a5d;
			padding:5px;
			border:none;
			border-radius:50px;
			outline:none;
		}
	</style>
	
</head>

<?php
	session_start();
	include("config.php");
	$error = "";
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
			$password =  $row["password"];
		}
	}
	

	
	if(isset($_POST['update'])){
		
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd1'];
		$gender = $_POST['gender'];
		$image = $_POST['image'];
		
		if(empty($_POST["image"])){
			$sql = "update users SET fullName = '$name', email = '$email', password = '$pwd', gender = '$gender' where userName = '$userName'";
		}
		else{
			$sql = "update users SET fullName = '$name', email = '$email', password = '$pwd', gender = '$gender', image = '$image' where userName = '$userName'";
		}
		
		if (mysqli_query($conn, $sql)) {
            
            echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
		} 
		else{
			echo "Error updating record: " . mysqli_error($conn);
		}
	}
	
	if(isset($_POST['delete'])){
		$sql = "delete from users where userName = '$userName'";
		if (mysqli_query($conn, $sql)) {
            
            echo "<script type='text/javascript'>window.location.href = 'Registration_Page.php';</script>";
		}
	}
?>
<body>
	<?php include('headerNavigation.php'); ?>
	
	<div class = "container">
			<div class = "row">
				<div class = "col-lg-3"></div>
				<div class = "col-lg-6">
					<div id = "interface">
						<form class = "form-group text-center" action = "editUser.php" method = "post" onsubmit = "return chckPassword()">
							<h2>User edit FORM</h2>
							<h4 style = "color : red;"><?php echo $error ?></h4>
							
							<img src = "../images/<?php echo $image ?>" style = "width:250px; height:250px;border-radius:90%;"class = "card-img-top"><br><br>
							<div class = "row">
								<div class = "col-lg-6">
									<label>Full name : </label>
									<input type =  "text" value = "<?php echo $name ?>" name = "name" class = "form-control" placeholder = "Enter full name" required >
								</div>
								
								<div class = "col-lg-6">
									<label>Gender : </label>
									<input type =  "text" name = "gender" class = "form-control" value = "<?php echo $gender ?>" placeholder = "Enter gender"  required >
								</div>
							</div>
							<br>
							<label>Email : </label>
							<input type =  "text" name = "email" value = "<?php echo $email ?>" class = "form-control" placeholder = "Enter email" pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required >
							<br>
							<div class = "row">
								<div class = "col-lg-6">
									<label>Password : </label>
									<input type =  "password" name = "pwd1" value = "<?php echo $password ?>" id = "pwd1" class = "form-control" placeholder = "Enter password" required>
								</div>
								
								<div class = "col-lg-6">
									<label>Re-type password : </label>
									<input type =  "password" name = "pwd2"  value = "<?php echo $password ?>" id = "pwd2" class = "form-control" placeholder = "Re-type password" required>
								</div>
							</div>
							<br>
							
							
							
							
							<div class = "row">
							
								<div class = "col-lg-6">
										<label>Input image : </label>
										<input type = "file" name = "image" id = "image" class = "upload" value = "Choose an image" >
								</div>
							</div>
							<br>
							<input type = "submit" name = "update" value = "Update" class = "btn btn-primary btn-block"><br>
							<input type = "submit" name = "delete" value = "Delete" class = "btn btn-danger btn-block"><br>
							<a href = "home.php"><input type = "button" name = "back" value = "Back" class = "btn btn-primary btn-block"></a>
						</form>
					</div>
				</div>
				<div class = "col-lg-3"></div>
			</div>
		</div>
		

</body>
</html>