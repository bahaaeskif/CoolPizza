 <?php 
	

		 include('db_connection.php');
		 // session_start();
 
	// give the intail values to varibles 
	$email = $userName = $password = $phone = $location = '';
	$error = ['email' => '' , 'userName' => '' , 'password' => '' , 'phone' => '' , 'location' =>''];


if (isset($_POST['submit'])) {
	if (empty($_POST['email'])){
		 $error['email']  = 'An email is required *';
	}else{
		 $email = $_POST['email'];
			if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
				$error['email'] = 'Email must be a valid email address *';
			}
	}

	if (empty($_POST['userName'])){
		 $error['userName']  = 'An name is required *';
	}else{
		$userName = $_POST['userName'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $userName)) {
				$error['userName'] = 'name must be a name contain the leeters and spaces only *';
			}
		}

			// check the password 


			if (empty($_POST['password'])){
		 $error['password']  = 'A password is required *';
	}else{
		$password = $_POST['password'];
			if (!preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/', $password)) {
				$error['password'] = ' Must be a minimum of 8 characters Must contain at least 1 number Must contain at least one uppercase character Must contain at least one lowercase character';
			}
			echo "$password" ;
		}

			if (empty($_POST['location'])){
		 $error['location']  = 'An location is required *';
	}else{
		$location = $_POST['location'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $location)) {
				$error['location'] = 'location must be a name contain the leeters and spaces only *';
			}
		}

			if (empty($_POST['phone'])){
		 $error['phone']  = 'An phone is required *';
	}else{
		$phone = $_POST['phone'];
			if (!preg_match('/^[0-9\s]+$/', $phone)) {
				$error['phone'] = 'location must be a name contain the numbers *';
			}
		}		

			if(array_filter($error)){
			//echo 'errors in form';
		} else {

			// check if the email where im enter it below is not exist
			$sql = "SELECT email  FROM customers WHERE email = '$email'" ;
			$result = mysqli_query($conn , $sql);
			$exsit = mysqli_fetch_assoc($result);
			if (empty($exsit)){
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$userName = mysqli_real_escape_string($conn, $_POST['userName']);
			$password = mysqli_real_escape_string($conn, $_POST['password']);
			$location = mysqli_real_escape_string($conn, $_POST['location']);
			$phone = mysqli_real_escape_string($conn, $_POST['phone']);

			// create sql
			$sql = "INSERT INTO customers(userName,password,email,phone,address) VALUES('$userName', '$password' , '$email' , '$phone' , '$location')";
			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				mysqli_free_result($result);
				mysqli_close($conn);
				header('Location: login.php');
			}else{
				echo 'query error: '. mysqli_error($conn);
			}
		}else{
			echo 'the user email is already exsit';
		}

		}
	
	}


 ?>

<!DOCTYPE html>
<html>
	<?php include('Tamplates/Header.php');?>

	<form action="sign_up.php" method="POST">
		<label>please enter your email:</label>
		<input type="text" name="email" value="<?php echo $email ?>">
		<div class="error"><?php echo $error['email']; ?></div>
		<label>please enter your name:</label>
		<input type="text" name="userName" value="<?php echo $userName ?>">
		<div class="error"><?php echo $error['userName']; ?></div>
		<label>please enter your password:</label>
		<input type="password" name="password" value="">
		<div class="error"><?php echo $error['password']; ?></div>
	    <label>please enter your phone:</label>
		<input type="text" name="phone" value="<?php echo $phone ?>">
		<div class="error"><?php echo $error['phone']; ?></div>
		<label>please enter your location:</label>
		<input type="text" name="location" value="<?php echo $location ?>">
		<div class="error"><?php echo $error['location']; ?></div>
		<input type="text" name="id" hidden>
		<div class="submit_data">
			<input type="submit" name="submit" value="SIGN-UP">
		</div>
	</form>

		<?php include('Tamplates/Footer.php');?>
</html>



