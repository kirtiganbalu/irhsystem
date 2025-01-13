<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:wlogin.php');
}
if(isset($_POST['save_warden'])){
    $name=($_POST['name']);
    $idnumber=($_POST['idnumber']);
    $phonenum=($_POST['phonenum']);
    $email=($_POST['email']);
    $gender=($_POST['gender']);
    $user_type=($_POST['position']);
    $block=($_POST['block']);
    $room_type=($_POST['room_type']);
    $password=md5($_POST['password']);
    $confirmpassword=md5($_POST['confirmpassword']);
    $tele=($_POST['tele']);
 
    $select = " SELECT * FROM signup_warden WHERE id_num = '$idnumber' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
    echo'<script>alert("USER ALREADY EXIST!")</script>';
 
    }else{
 
       if($password != $confirmpassword){
        echo'<script>alert("PASSWORD NOT MATCHED!")</script>';
       }else{
        $camera="noprofil.jpg";
          $insert = "INSERT INTO signup_warden(Warden_ID,Name,id_num,phone_num,email,gender,user_type,block,Room_Type,tele_id,password,camera) VALUES('','$name','$idnumber','$phonenum','$email','$gender','$user_type','$block','$room_type','$tele','$password','$camera')";
          mysqli_query($conn, $insert);
          $error[]='Data Inserted!';
       }
    }
 };
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Add Warden</title>
</head>
<style>
.card-header .error-msg{
	margin:10px 0;
	display: block;
	background: rgb(153, 237, 128);
	color: rgb(11, 11, 11);
	border-radius: 5px;
	font-size: 20px;
	padding:14px;


}
</style>
<body>
  
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Warden Add 
                            <a href="kw_wardenlist.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                        <?php

if (isset($error)){
    foreach($error as $error){
        echo '<span class="error-msg">'.$error.'</span>';
    };
};

?><br>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">

                            <div class="mb-3">
                                <label>Warden Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>ID Number</label>
                                <input type="text" name="idnumber" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Phone Number</label>
                                <input type="text" name="phonenum" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                            <div class="custom_select">
                            <label>Gender</label>
                               <select class="form-control" name="gender" style="width:100%; padding:4px;" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                               </select>
                            </div>
                            </div>
                            <div class="mb-3" >
                            <div class="custom_select">
                           <label> Warden Position</label>
                            <select class="form-control" name="position" style="width:100%; padding:4px;" required>
                               <option value="">Select</option>
                               <option value="Ketua Warden">Ketua Warden</option>
                               <option value="Warden">Warden</option>
                            </select>
                            </div>
                            </div>
                            <div class="mb-3">
                            <div class="custom_select">
                            <label>Block</label>
                            <select class="form-control" name="block" style="width:100%; padding:4px;" required>
                               <option value="">Select</option>
                               <option value="DA">DA</option>
                               <option value="DB">DB</option>
                               <option value="DC">DC</option>
                               <option value="DD">DD</option>
                               <option value="TA">TA</option>
                               <option value="TB">TB</option>
                               <option value="TC">TC</option>
                               <option value="TD">TD</option>
                               <option value="PA">PA</option>
                               <option value="PB">PB</option>
                               <option value="PC">PC</option>
                               <option value="PD">PD</option>
                            </select>
                            </div>
                            </div>
                            <div class="mb-3">
                            <div class="custom_select">
                            <label>Room Type</label>
                            <select class="form-control" name="room_type" style="width:100%; padding:4px;" required>
                            <option value="">Select</option>
                            <option value="NONE">NONE</option>
                            <option value="genap">genap</option>
                            <option value="ganjil">ganjil</option>
                            </select>
                            </div>
                            </div>
                            <div class="mb-3">
                                <label>Tele Id</label>
                                <input type="text" name="tele" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="text" name="confirmpassword" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="save_warden" class="btn btn-primary">Save Warden</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>