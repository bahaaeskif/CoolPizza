<?php 
	 
	 include('db_connection.php');
	 $id = '';
// this session come from login

	// add the value come from the login and put it in id 
session_start();
 $id = $_SESSION['customer_id'];

if ($_SESSION['customer_id']){

   

	$id = mysqli_real_escape_string($conn,$_SESSION['customer_id']);

	// return all info where the user id 
	$sql = "SELECT pizza_name , descreption , order_id FROM
orders JOIN pizza_type WHERE
orders.pizza_type_id = pizza_type.pizza_type_id and customer_id = $id ;" ;

	// make a query 

	$result = mysqli_query($conn , $sql);

	// transform $result to correct format

	// in piizas there is all pizzas 

	$pizzas = mysqli_fetch_all($result , MYSQLI_ASSOC);

	// free result from the memory

	mysqli_free_result($result);

	// close the connection 

	mysqli_close($conn);
}else{
	header('Location: login.php');
}


 ?>

<!DOCTYPE html>
<html>
	<?php include('Tamplates/Header.php');?>
			
			<h4 class='title'>Pizzas!</h4>

	<div class="container">
		<?php if ($id): ?>
		<div class="cards">
			 
			<?php foreach($pizzas as $pizza): ?>

				<div class="card">
					<img src="img/pizza.svg"class="pizza">
						<div class="card-content">
							<h6><?php echo htmlspecialchars($pizza['pizza_name']); ?></h6>
							<h6><?php echo $pizza['descreption'] ?></h6>
						</div>
						<div class="card-action">
							<a class="brand-text" href="details.php?id=<?php echo $pizza['order_id']; ?>">more info</a>
						</div>
				</div>
				<?php endforeach; ?>
				</div>

			
		<?php else: ?>

<div class="container">
			<div class="error_login">
			<h6 >please login before using the site</h6>

			</div>
			</div>

		<?php endif; ?>


		
	</div>

	<?php include('Tamplates/Footer.php');?>
</html>






<!-- 
SELECT pizza_name , descreption , pizza_count , comment FROM
orders JOIN pizza_type WHERE
orders.pizza_type_id = pizza_type.pizza_type_id and customer_id = 7; -->





