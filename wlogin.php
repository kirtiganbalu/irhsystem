<?php
@include 'config.php';
session_start();

 if(isset($_POST['sign_in'])){

    $idnumber=($_POST['idnumber']);
    $password=md5($_POST['password']);

 
    $select = " SELECT * FROM signup_warden WHERE id_num = '$idnumber' && password = '$password' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $row = mysqli_fetch_array($result);
       
       $user_type=$row['user_type'];
       if($user_type == 'Warden'){
        $_SESSION['Warden_ID']=$row['Warden_ID'];
          $_SESSION['admin_id'] = $idnumber;
          $_SESSION['user_name'] = $row['Name'];
          $_SESSION['gender'] = $row['gender'];
          $_SESSION['camera']= $row['camera'];
          $_SESSION['block']= $row['block'];
          $_SESSION['email']= $row['email'];
          $_SESSION['user_type']= $row['user_type'];
          $_SESSION['password']=$row['password'];
          $_SESSION['phone_num']= $row['phone_num'];
          $_SESSION['Room_Type']= $row['Room_Type'];
          header('location:whome.php');
 
       }elseif($user_type == 'Ketua Warden'){
        $_SESSION['Warden_ID']=$row['Warden_ID'];
          $_SESSION['admin_id'] = $idnumber;
          $_SESSION['user_name'] = $row['Name'];
          $_SESSION['gender'] = $row['gender'];
          $_SESSION['camera']= $row['camera'];
          $_SESSION['block']= $row['block'];
          $_SESSION['email']= $row['email'];
          $_SESSION['user_type']= $row['user_type'];
          $_SESSION['password']=$row['password'];
          $_SESSION['phone_num']= $row['phone_num'];
          $_SESSION['Room_Type']= $row['Room_Type'];
          header('location:kwhome.php');
 
       }
      
    }else{
        echo'<script>alert("INCORRECT IC OR PASSWORD!")</script>';
       $error1[] = 'INCORRECT ID NUMBER or PASSWORD!';
    }
 
 };
 
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Warden</title>
	<link rel="stylesheet" type="text/css" href="css/wlogin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container" id="container">
<div class="form-container sign-in-container">
	<form action="#" method="post">
		<h1>Sign In</h1>
        <?php
      if(isset($error1)){
         foreach($error1 as $error1){
            echo '<span class="error-msg">'.$error1.'</span>';
         };
      };
      ?>
    <p></p>
	<input type="number" name="idnumber" placeholder="ID Number">
	<input type="password" name="password" placeholder="Password">
	<a class="txt1 "href="wforgot.php">Forgot Password ?</a>
    <div class="btn">
        <input type="submit" value=" Sign In" name="sign_in">
    </div>
    </form>
</div>
<div class="overlay-container">
	<div class="overlay">
		<div class="overlay-panel overlay-right">
			<h1>Welcome To <br><span>iRH</span> System</br></h1>
			<p>To Keep Connected With Us Please Login With Your Personal Info</p>
		</div>
	</div>
</div>
</div>



</body>
</html>