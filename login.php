<?php




    
    $email = $password = '';
    $exsit ='';
    $error = ['exsit' => ''];
  include('db_connection.php');

    if (isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
     //check if the account is already exist
    $sql = "SELECT email , password  FROM customers WHERE email = '$email' and password = '$password' " ;
    // transform $result to correct format
    $result = mysqli_query($conn , $sql);
    $exsit = mysqli_fetch_assoc($result);
    if (isset($exsit)){
            $sql = "SELECT  customer_id  FROM customers WHERE email = '$email'" ;
            $result = mysqli_query($conn , $sql);
            $exsit = mysqli_fetch_assoc($result);
            // sent the id to all pages 
            session_start();
             $_SESSION['customer_id'] = $exsit['customer_id']; 
             mysqli_free_result($result);

    // close the connection 
    mysqli_close($conn);
  print_r($exsit['customer_id']);
  session_start();
  $_SESSION['customer_id'] = $exsit['customer_id'];
                header('Location: index.php');
                     // if the emails exist send this emails to all pages

                }else{
                    $error['exsit'] = 'please sighn up *';
                }
            }
 
 ?>

<!DOCTYPE html>
<html>
    <?php include('Tamplates/Header.php');?>

<section class="php-form">
        <div class="container">
            
            <div class="error_login">
            <h6 >please login before using the site </h6>
            </div>
<form action="login.php" method="POST">
    <label>Enter your Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" >
    <label>Enter your password:</label>
    <input type="text" name="password" value="<?php echo htmlspecialchars($password); ?>" >
                    <a href="sign_up.php"><div class="error"><?php  echo $error['exsit'];  ?></div></a>
  <div class="submit_data">
                    <input type="submit" name="submit" value="Login">
                </div>
                <!-- in case the email is not login show up sign up btn --> 
</form>

        </div>
</section>


    <?php include('Tamplates/Footer.php');?>
</html>
