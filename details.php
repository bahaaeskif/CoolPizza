<?php 
	
	 include('db_connection.php');
	 // session_start();
	 //  $id= $_SESSION['id'];

	// check the GET request 
	if(isset($_GET['id'])){

		$id = mysqli_real_escape_string($conn, $_GET['id']);
		// double qoute 

		 // "SELECT * FROM orders WHERE order_id = ";

		$sql = "SELECT userName , phone , address , email , comment , pizza_count FROM orders JOIN customers WHERE orders.customer_id = customers.customer_id and order_id = $id;";

		$result = mysqli_query($conn , $sql);

		$pizzas_daitels = mysqli_fetch_assoc($result);

		mysqli_free_result($result);

		mysqli_close($conn);
	}

	// id press on buuton delete sent these data to php to deal with it 

	if(isset($_POST['submit'])){
			$deleteId = mysqli_real_escape_string($conn, $_POST['delete']);
			$sql = "DELETE FROM orders WHERE order_id = $deleteId ";
			if(mysqli_query($conn , $sql)){
				header('Location: index.php');
			}
		    mysqli_close($conn);
	}
	
 ?>

<!DOCTYPE html>
<html>
<?php include('Tamplates/Header.php');?>

	
			<div class="container">
				
			<form  class ="delete" action="details.php" method="POST">
				<div class="details">
				<?php if($pizzas_daitels): ?>
				<h4><?php echo 'order\'s name: '. htmlspecialchars($pizzas_daitels['userName']);  ?></h4>
				 <p><?php  echo 'order\'s address: ' . htmlspecialchars($pizzas_daitels['address']);?></p>
				  <p><?php  echo 'order\'s phone: ' .htmlspecialchars($pizzas_daitels['phone']);?></p>
				   <p><?php  echo 'order\'s email: ' .htmlspecialchars($pizzas_daitels['email']);?></p>
				<p> <?php echo 'comment: ' . htmlspecialchars($pizzas_daitels['comment']); ?></p>
				
				<p><?php echo 'count: ' . htmlspecialchars($pizzas_daitels['pizza_count']); ?></p>
			</div>
				<!-- put the id value which we got from index.php when we retreive all data abput pizza   -->
				<input type="text" name="delete" hidden value="<?php echo $id ?>">
				<div class="submit_data">
				<input type="submit" name="submit" value="delete">
				</div>
			</form>

		<?php else: ?>
			
			<h5>No Such Pizza exsit!!!</h5>
		<?php endif; ?>
</div>

<?php include('Tamplates/Footer.php');?>
</html>