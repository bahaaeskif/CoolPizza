<?php 
	
	include('db_connection.php');

		 session_start();
		 $count_validate =$add= '';
		 $error = ['count_validate' => '' , 'add' => ''];
	// put the id that come from in log in	

		$customer_id =$_SESSION['customer_id'];

		// return the name of pizza where is added by admin 
	// $pizza_type = '';

	 $sql = "SELECT pizza_name , descreption , price from pizza_type ";

	 $result = mysqli_query($conn,$sql);

	 $pizza_type = mysqli_fetch_all($result , MYSQLI_ASSOC);

		// end block

		if (isset($_POST['submit'])){



			// check pizza_count if empty or not contain numbers
			if (empty($_POST['comment'])){
		 $error['add']  = 'A comment is required *'; 
		}
			if (empty($_POST['pizza_count'])){
		 $error['count_validate']  = 'An pizza_count is required *';
	}else{
		$pizza_count = $_POST['pizza_count'];
			if (!preg_match('/^[0-9\s]+$/', $pizza_count)) {
				$error['count_validate'] = 'pizza count must be numbers *';
			}
		}
		// print_r($error);
			if(empty($error['count_validate'])){

			$pizza_name = mysqli_real_escape_string($conn, $_POST['pizza_type']);
	
			$sql = "SELECT pizza_type_id from pizza_type where
			 pizza_name = '$pizza_name' ";

			 $result = mysqli_query($conn,$sql);

			 $pizza_type_id = mysqli_fetch_assoc($result);


		// $pizza_name = mysqli_real_escape_string($conn, $_POST['pizza_type']);

		$comment = mysqli_real_escape_string($conn, $_POST['comment']);
		$pizza_count = mysqli_real_escape_string($conn, $_POST['pizza_count']);

		$pizza_type_id = $pizza_type_id['pizza_type_id'];
		// create sql

		$sql = "INSERT INTO orders (customer_id ,pizza_type_id, comment , pizza_count) VALUES
		('$customer_id','$pizza_type_id' , '$comment' , '$pizza_count')";




			// save to db and check
			if(mysqli_query($conn, $sql)){
				// succss
	             mysqli_close($conn);
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}




		}




	 }

	 // END BLOCK HERE 




 ?>

<!DOCTYPE html>
<html>
	<?php include('Tamplates/Header.php');?>
	<section class="php-form">
		<div class="container">
			<h4>Add A Pizza</h4>
			<form action="add.php" method="POST">
	<select name="pizza_type" class="select">
	<option value="">Select Pizza type:</option>
	<?php foreach ($pizza_type as $type){  ?>
	<option value="<?php echo $type['pizza_name'] ?>"><?php echo $type['pizza_name'] . ' - ' . $type['price'] . '$' . ' ' . $type['descreption'] ;  ?></option>
	<?php } ?>
	</select>
	<p>please write for us what would you add :</p>
	<input type="text" name="comment">
	<div class="error"><?php echo $error['add']; ?></div>
	<p>how many of pizza you want order:</p>
	<input type="text" name="pizza_count">
		<div class="error"><?php echo $error['count_validate']; ?></div>
				<div class="submit_data">
					<input type="submit" name="submit" value="submit">
				</div>
			</form>
		</div>
	</section>		
	<?php include('Tamplates/Footer.php');?>
</html>