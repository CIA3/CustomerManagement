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

	if(isset ($_POST['submit'])){
		
		$name = $_POST['name'];
		$uName = $_POST['username'];
		$email = $_POST['email'];
		$pwd = $_POST['pwd1'];
		$gender = $_POST['gender'];
		$image = $_POST['image'];
		
		$j = 0;
		$p = 0;
		$sql = "SELECT userName, email FROM users";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
		  {
			if($row["userName"] === $uName && $row["email"]=== $email)
			{
				$j = 1;
				$p = 1;
			}
			else if($row["userName"] === $uName)
			{
				$j = 1;

			}
			
			else if($row["email"] === $email)
			{
				$p = 1;
			}
			
			
		  }
		}
		
		if($j == 0 && $p == 0)
		{	
			$sql1 = "INSERT INTO users (fullName, email, userName, password, gender, role, image)
			VALUES ('$name', '$email', '$uName','$pwd', '$gender', 'Customer', '$image')";
			if ($conn->query($sql1) == TRUE){
				
					$_SESSION["user"] = $uName;
					echo "<script type='text/javascript'>window.location.href = 'home.php';</script>";
			}
		}
		
		else if($j == 1 && $p == 1){
			$error = 'User name and email already exist';
		}
		
		else if($p == 1){
			$error = 'Email already exist';
		}
		else if($j == 1) {
			$error = "User name already exist";
		}
		else{
			$j = 0;
			$p = 0;
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
						<form class = "form-group text-center" action = "Registration_Page.php" method = "post" onsubmit = "return chckPassword()">
							<h2>REGISTRATION FORM</h2>
							<h4 style = "color : red;"><?php echo $error ?></h4>
							<div class = "row">
								<div class = "col-lg-6">
									<label>Full name : </label>
									<input type =  "text" name = "name" class = "form-control" placeholder = "Enter full name" required >
								</div>
								
								<div class = "col-lg-6">
									<label>User name : </label>
									<input type =  "text" name = "username" class = "form-control" placeholder = "Enter full user name" required>
								</div>
							</div>
							<br>
							<label>Email : </label>
							<input type =  "text" name = "email" class = "form-control" placeholder = "Enter email" pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required >
							<br>
							<div class = "row">
								<div class = "col-lg-6">
									<label>Password : </label>
									<input type =  "password" name = "pwd1" id = "pwd1" class = "form-control" placeholder = "Enter password" required>
								</div>
								
								<div class = "col-lg-6">
									<label>Re-type password : </label>
									<input type =  "password" name = "pwd2"  id = "pwd2" class = "form-control" placeholder = "Re-type password" required>
								</div>
							</div>
							<br>
							<select class = "form-control" name = "gender">
								<option>Choose Gender...</option>
								<option>Male</option>
								<option>Female</option>
								<option>Other</option>
							</select>
							<br>
							<div class = "row">
							
								<div class = "col-lg-6">
										<label>Input image : </label>
										<input type = "file" name = "image" id = "image" class = "upload" value = "Choose an image" >
								</div>
							</div>
							<br>
							<input type = "submit" name = "submit" value = "Submit" class = "btn btn-primary btn-block">
						</form>
					</div>
				</div>
				<div class = "col-lg-3"></div>
			</div>
		</div>
		

</body>
</html>