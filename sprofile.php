<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['icnum'])){
  header('location:slogin.php');
}


if(isset($_FILES["webcam"]["name"])){
	$src = $_FILES["webcam"]["tmp_name"];
	$imageName = uniqid() . $_FILES["webcam"]["name"];

	$target = "img/" . $imageName;

	move_uploaded_file($src, $target);

	$query = "UPDATE signup_student SET camera = '$imageName' WHERE  Student_ID='".$_SESSION['Student_ID']."'";
	mysqli_query($conn, $query);

  }



if(isset($_POST['update_profile'])){

    $name=strtoupper($_POST['name']);
    $regnum=strtoupper($_POST['regnum']);
    $phonenum=($_POST['phonenum']);
    $email=($_POST['email']);
    $parentnum=($_POST['parentnum']);
    $address=($_POST['address']);
    $roomnum=($_POST['roomnum']);
    $block=($_POST['block']);
    $Student_ID=($_POST['Student_ID']);

      if($roomnum % 2==0){
         $room_type="genap";

         $ic=($_POST['ic']);
         $gender=($_POST['gender']);
         $parentname=strtoupper($_POST['parentname']);
         $text=$_POST['text'];
         $query="UPDATE signup_student set name='$name',reg_num='$regnum',phone_num='$phonenum',email='$email',ic_num='$ic',gender='$gender',parent_name='$parentname',parent_num='$parentnum',address='$address',room_num='$roomnum',block='$block',sroom_type='$room_type',capture='$text' WHERE Student_ID='$Student_ID'";
         $res=mysqli_query($conn,$query);
         echo'<script>alert("Data Inserted!")</script>';
      }else{
         $room_type="ganjil";
         
         $ic=($_POST['ic']);
         $gender=($_POST['gender']);
         $parentname=strtoupper($_POST['parentname']);
         $text=$_POST['text'];
         
         $query="UPDATE signup_student set name='$name',reg_num='$regnum',phone_num='$phonenum',email='$email',ic_num='$ic',gender='$gender',parent_name='$parentname',parent_num='$parentnum',address='$address',room_num='$roomnum',block='$block',sroom_type='$room_type',capture='$text' WHERE Student_ID='$Student_ID'";
         $res=mysqli_query($conn,$query);
         echo'<script>alert("Data Inserted!")</script>';
       }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/sprofile.css">

</head>
<style media="screen">
    .upload{
      width: 230px;
      position: relative;
      margin: auto;
      text-align: center;
    }
    .upload img{
      border-radius: 2%;
      border: 8px solid #DCDCDC;
      width: 230px;
      height: 225px;
    }
    .upload .rightRound{
      position: absolute;
      bottom: 0;
      right: 0;
      background: #00B4FF;
      width: 37px;
      height: 35px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }
    .upload .leftRound{
      position: absolute;
      bottom: 0;
      left: 0;
      background: red;
      width: 37px;
      height: 35px;
      line-height: 32px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;
    }
    .upload .fa{
      color: white;
    }
    .upload input{
      position: absolute;
      transform: scale(2);
      opacity: 0;
    }
    .upload input::-webkit-file-upload-button, .upload input[type=submit]{
      cursor: pointer;
    }
  </style>
<body>
   
<div class="update-profile">

<form action="#" method="post">
      <div class="flex">
      <input type="hidden" name="Student_ID" value="<?php echo $_SESSION['Student_ID']; ?>">
<input type="hidden" name="gender" value="<?php echo $_SESSION['gender']; ?>">
<input type="hidden" name="ic" value="<?php echo $_SESSION['icnum']; ?>">
<input type="hidden" name="parentname" value="<?php echo $_SESSION['parent_name']; ?>">
<input type="hidden" name="text" value="<?php echo $_SESSION['capture']; ?>">
<input type="hidden" name="camera" value="<?php echo $_SESSION['camera']; ?>">
<input type="hidden" name="old_password" value="<?php echo $_SESSION['password']; ?>">
         <div class="inputBox">
         <?php
                            require 'config.php';
                            $query = "SELECT * FROM signup_student WHERE Student_ID='".$_SESSION['Student_ID']."'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {

                                
                           

                                    ?>
            
            <div class="upload">
        <img src="img/<?php echo $student['camera']; ?>" id = "image">


        <div class="leftRound" >
          <input type="button" value="<?php echo $_SESSION['Student_ID']; ?>" class="btn btn-warning text-white" id="accesscamera" data-toggle="modal" data-target="#photoModal">
          <i class = "fa fa-camera"></i>
        </div>

        <div class="leftRound" id = "cancel" style = "display: none;">
          <i class = "fa fa-times"></i>
        </div>
        <div class="rightRound" id = "confirm" style = "display: none;">
          <input type="submit">
          <i class = "fa fa-check"></i>
        </div>
      </div>

      <span>username :</span>
            <input type="text" name="name" value="<?= $student['name'] ?>" class="box">
            <span>Registration No :</span>
            <input type="text" name="regnum" value="<?= $student['reg_num']?>" class="box">
            <span> Phone Number:</span>
            <input type="number" name="phonenum" value="<?= $student['phone_num']?>" class="box">
            <span>Parent Number :</span>
            <input type="number" name="parentnum" value="<?= $student['parent_num']?>" class="box">
            <span>your email :</span>
            <input type="email" name="email" value="<?= $student['email']?>" class="box">

      
         </div>
         <div class="inputBox">

         <span>Address :</span>
            <textarea name="address" class="textarea"><?= $student['address']?></textarea>
            <span>Room Number :</span>
            <input type="number" name="roomnum" value="<?= $student['room_num']?>" class="box">
      <span>Block :</span>
                <select name="block" id="selectA" class="box">
                  <option value="<?php echo $_SESSION['block'];?>"><?= $student['block']?></option>
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

                <span>Reset password :</span>
                <a href="snewpassword.php" class="delete-btn" style="text-decoration: none; background-color:cadetblue; color:black;">Reset Password</a> 
                <?php 
                                
                                
                              }
                          }
                              ?>
           
         </div>
      </div>
                    
      <input type="submit" value="Re-edit" name="update_profile" class="btn">
      <form action="shome.php">
      <a href="shome.php" class="delete-btn" style="text-decoration: none; color:black;">go back</a>
   </form>
</form>

</div>

<!--Modal-->
<div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Capture Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div id="my_camera"  class="d-block mx-auto rounded overflow-hidden"></div>
                    </div>
                    <div id="results" class="d-none"></div>
                    <form method="post" id="photoForm">
                    <input type="hidden" name="Student_ID" value="<?php echo $_SESSION['Student_ID']; ?>">
                        <input type="hidden" id="photoStore" name="photoStore" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit"  class="btn btn-warning mx-auto text-white" id="uploadphoto" form="photoForm">Capture Photo</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script src="./plugin/sweetalert/sweetalert.min.js"></script>
    <script src="./plugin/webcamjs/webcam.min.js"></script>
    <script>
    $(document).ready(function() {
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    $('#accesscamera').on('click', function() {
        Webcam.reset();
        Webcam.on('error', function() {
            $('#photoModal').modal('hide');
            swal({
                title: 'Warning',
                text: 'Please give permission to access your webcam',
                icon: 'warning'
            });
        });
        Webcam.attach('#my_camera');
        
    });


    $('#close').on('click', close);

    $('#photoForm').on('submit', function(e) {
        Webcam.snap( function(data_uri) {
            Webcam.upload( data_uri, 'sprofile.php', function(code, text,Name) {
                            document.getElementById('my_camera').innerHTML = 
                            '' + 
                    '<img src="' + data_uri + '"style=" width: 300px;">';

                   
         } );
        
          
         } );
    })
})



function close()
{
    Webcam.reset();

}
</script>
</body>
</html>