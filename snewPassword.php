<?php 
@include 'config.php';
session_start();

if(isset($_POST['update_profile'])){
    $password=md5($_POST['newpass']);
    $confirmpass=md5($_POST['confirmpass']);
    $passwordcheck=md5($_POST['password']); 

    $Student_ID=($_POST['Student_ID']);
    $select = " SELECT password FROM signup_student WHERE Student_ID='$Student_ID' and password='$passwordcheck' ";

$result = mysqli_query($conn, $select);
   
if(mysqli_num_rows($result) === 1){ 
    if($password != $confirmpass){
      echo'<script>alert("NEW PASSWORD and CONFIRM PASSWORD NOT MATCHED!")</script>';
    }else{
        $query="UPDATE signup_student set password='$password' WHERE Student_ID='$Student_ID'";
        $res=mysqli_query($conn,$query);
         header('location:sprofile.php');
      }  
}
else{
    echo'<script>alert("Old PASSWORD NOT MATCHED!")</script>';
 }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/newpassword.css">
</head>
<body>
<div id="container">
        <h2>Password</h2>
        <p>It's quick and easy.</p>
        <div id="line"></div>
        <form action="" method="POST" autocomplete="off">
        <input type="hidden" name="Student_ID" value="<?php echo $_SESSION['Student_ID']; ?>">
        <input type="password" name="password" placeholder="Old Password" required><br>
            <input type="password" name="newpass" placeholder="New Password" required><br>
            <input type="password" name="confirmpass" placeholder="Confirm Password" required><br>
            <input type="submit" name="update_profile" value="Save">
        </form>
    </div>
</body>
</html>