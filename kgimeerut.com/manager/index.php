<?php include 'config.php';
	if(isset($_SESSION['username'])){
		echo "<script>window.location.href='{$path}manager/dashboard.php'</script>";
	}
	$err = "";
	if(isset($_POST['login'])){
		$userName = trim(mysqli_real_escape_string($con, $_POST['userName']));
		$password = trim(mysqli_real_escape_string($con, md5($_POST['password'])));

		$sqlcheck = mysqli_query($con, "SELECT * FROM admin WHERE username = '{$userName}' AND password = '{$password}'");
		if(mysqli_num_rows($sqlcheck)){
			while($row = mysqli_fetch_assoc($sqlcheck)){
				$_SESSION['username'] = $row['username'];
				echo "<script>window.location.href='{$path}manager/dashboard.php';</script>";
			}
		}else{
			// echo "<script>alert('Invalid Username or Password.');</script>";
			$err = "Invalid Username or Password";
		}
		
	}

?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$rwlinks['web_name'];?></title>
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
	<link rel="icon" type="image/x-icon" href="<?=$path;?>branch/images/favicon.ico">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive-style.css">
</head>
<body>
<div class="wrapper">
<!--<div class="container-fluid">-->
<!--<div class="row">-->
<!--<div class="col-md-8"></div>-->
<!--<div class="col-md-4">-->
<div class="wrapper-right">
	<div class="logo">
		<?php if(empty($rwlinks['logo'])){ ?>
			<h3><?=$websitename;?></h3>
		<?php }else{ ?>
		<img src="<?php echo $path.$rwlinks['logo']; ?>" alt="logo">
		<?php } ?>
	</div>
	<div class="admin-form">
		<form method="POST">
			<small class=""><?=$err;?></small>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
				<input type="text" name="userName" class="form-control" placeholder="Username" required autofocus='on' autocomplete="off">
			</div>
			<div class="input-group mb-3">
				<span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
				<input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
			</div>
			<input type="submit" name="login" value="Login">
		</form>	
	</div>
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
</div>

</body>
</html>