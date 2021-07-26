<html>
<head><title>Login page</title>

	<link rel = "stylesheet"  href = "../css/Reg_style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
	
	<script>
		function myFunction() {
			var x = document.getElementById("pwd1");
				if (x.type === "password") {
					x.type = "text";
					} else {
				x.type = "password";
				}
			}
</script>


<?php
	session_start();
	$error = '';
	include("config.php");
	
	
	
	if(isset($_POST['bt1'])){
		
		$uName = $_POST['username'];
		$password = $_POST['pwd1'];
	
		$sql = "SELECT * FROM users";
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				$role =  $row["role"];
				
				if($row["userName"] == $uName && $row["password"] == $password)
				{
					if($role==="Customer"){
						$_SESSION["user"] = $uName;
					 
						header("location: home.php");
					}
					else if($role === "Admin"){
						$_SESSION["user"] = $uName;
					 
						header("location: adminHome.php");
					}
				}
				
				else
				{
					$error = 'Invalid username or password';

				}
			}
		
		} 
	}
 

?>


	
</head>

<body>
	<?php include('headerNavigation.php'); ?>
	
	<div class = "container">
			<div class = "row">
				<div class = "col-lg-3"></div>
				<div class = "col-lg-5">
					<div id = "interface">
						<form method = "post" action = "Login.php" class = "form-group text-center">
							<h2>Login Form</h2>
							<div class = "row">
				
									<label>User name : </label>
									<input type =  "text" name = "username" class = "form-control" placeholder = "Enter full user name" required>
					
							</div>
							<br>
							<div class = "row">
							
									<label>Password : </label>
									<input type =  "password" name = "pwd1" id = "pwd1" class = "form-control" placeholder = "Enter password" required>
				
							</div>
							<br><h4 style = "color : red;"><?php  echo $error; ?></h4>
							<input type="checkbox" onclick="myFunction()"><label>Show Password</label><br>
							
							<br>
							<input type = "submit" name = "bt1" value = "Submit" class = "btn btn-primary btn-block">
						</form>
					</div>
				</div>
				<div class = "col-lg-3"></div>
			</div>
		</div>



</body>
</html>