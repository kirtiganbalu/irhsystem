<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:wlogin.php');
}
if(isset($_POST['edit_warden'])){
    $warden_id=($_POST['warden_id']);
    $name=($_POST['name']);
    $idnumber=($_POST['idnumber']);
    $phonenum=($_POST['phonenum']);
    $email=($_POST['email']);
    $gender=($_POST['gender']);
    $user_type=($_POST['position']);
    $block=($_POST['block']);
    $room_type=($_POST['room_type']);
    $tele=$_POST['tele'];

    $query="UPDATE signup_warden SET Name='$name',id_num='$idnumber',phone_num='$phonenum',email='$email',gender='$gender',user_type='$user_type',block='$block',Room_Type='$room_type',tele_id='$tele' WHERE Warden_ID='$warden_id'";
    $query_run=mysqli_query($conn,$query);

    if($query_run)
    {
        echo'<script>alert("Data Inserted!")</script>';
        $error[]='Data Inserted!';
    }else{
        echo'<script>alert("Data Not Inserted!")</script>';
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

    <title>Edit Warden</title>
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
                        <h4>Warden Edit 
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
                        <?php 
                        @include 'config.php';
                        if(isset($_GET['id']))
                        {
                            $warden_id=$_GET['id'];
                            $query="SELECT * FROM signup_warden WHERE Warden_ID='$warden_id'";
                            $query_run=mysqli_query($conn,$query);

                            if(mysqli_num_rows($query_run)>0){
                                $warden_id=mysqli_fetch_array($query_run);
                                ?>
                        <form action="#" method="POST">
                            <input type="hidden" name="warden_id" value="<?=$warden_id['Warden_ID']?>">
                            <div class="mb-3">
                                <label>Warden Name</label>
                                <input type="text" name="name" value="<?=$warden_id['Name'];?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>ID Number</label>
                                <input type="text" name="idnumber" value="<?=$warden_id['id_num'];?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Phone Number</label>
                                <input type="text" name="phonenum" value="<?=$warden_id['phone_num'];?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="<?=$warden_id['email'];?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Tele ID</label>
                                <input type="text" name="tele" value="<?=$warden_id['tele_id'];?>" class="form-control" required>
                            </div>


                            <div class="mb-3">
                            <div class="custom_select">
                            <label>Gender</label>
                               <select name="gender" style="width:100%; padding:4px;" class="form-control"  required>

                               <option  value="<?=$warden_id['gender'];?>"><?=$warden_id['gender'];?></option>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                               </select>
                            </div>
                            </div>
                            <div class="mb-3" >
                            <div class="custom_select">
                           <label> Warden Position</label>
                            <select name="position" style="width:100%; padding:4px;" class="form-control" required>

                            <option  value="<?=$warden_id['user_type'];?>"><?=$warden_id['user_type'];?></option>
                               <option value="">Select</option>
                               <option value="Ketua Warden">Ketua Warden</option>
                               <option value="Warden">Warden</option>
                            </select>
                            </div>
                            </div>
                            <div class="mb-3">
                            <div class="custom_select">
                            <label>Block</label>
                            <select name="block" style="width:100%; padding:4px;" class="form-control" required>

                            <option value="<?=$warden_id['block'];?>"><?=$warden_id['block'];?></option>
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
                            <select name="room_type" style="width:100%; padding:4px;" class="form-control" required>
                            <option value="<?=$warden_id['Room_Type'];?>"><?=$warden_id['Room_Type'];?></option>
                               <option value="">Select</option>
                               <option value="NONE">NONE</option>
                               <option value="genap">genap</option>
                               <option value="ganjil">ganjil</option>
                            </select>
                            </div>
                            </div>                        
                            <div class="mb-3">
                                <button type="submit" name="edit_warden" class="btn btn-primary">Edit Warden</button>
                            </div>

                        </form>
                        <?php

}else{
    echo"<h4>No such Id found</h4>";
}
}
?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>