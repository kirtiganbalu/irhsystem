<?php
@include 'config.php';
session_start();
if(isset($_POST['sign_up'])){

    if(strlen(trim($_POST['password']))<8){
        echo'<script>alert("Password must have atleast more than 6 characters!")</script>'; 

    }else{

    $name=strtoupper($_POST['name']);
    $regnum=strtoupper($_POST['regnum']);
    $phonenum=($_POST['phonenum']);
    $email=($_POST['email']);
    $ic=($_POST['ic']);
    $gender=($_POST['gender']);
    $parentname=strtoupper($_POST['parentname']);
    $parentnum=($_POST['parentnum']);
    $address=($_POST['address']);
    $roomnum=($_POST['roomnum']);
    $block=($_POST['block']);
    $password=md5($_POST['password']);
    $confirmpass=md5($_POST['confirmpass']);
    $text =$_POST['text'];

    $select1="SELECT * FROM tblasrama WHERE nokp='$ic' and nopend='$regnum'";
    $result1=mysqli_query($conn,$select1);
    if(mysqli_num_rows($result1))
    {

    $select="SELECT * FROM signup_student WHERE ic_num='$ic'";

    $result =mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0){
        echo'<script>alert("USER ALREADY EXIST!")</script>';
        $error[]='USER ALREADY EXIST!';

    }else{
        if($password != $confirmpass){
            echo'<script>alert("PASSWORD NOT MATCHED!")</script>';
            $error[]='PASSWORD NOT MATCHED!';

        }elseif($text != $ic){
            echo'<script>alert("IC NOT MATCHED!")</script>';
            $error[]='IC NOT MATCHED!';
        }
        else{
            if($roomnum % 2==0){
                $room_type="genap";
                $camera="noprofil.jpg";
            $insert="INSERT INTO signup_student(Student_ID,name,reg_num,phone_num,email,ic_num,gender,parent_name,parent_num,address,room_num,block,sroom_type,password,capture,camera) VALUES('',' $name','$regnum','$phonenum','$email','$ic','$gender','$parentname','$parentnum','$address','$roomnum','$block','$room_type','$password','$text','$camera')";
            mysqli_query($conn, $insert);
            header('location:slogin.php');
            }else{
                    $room_type="ganjil";
                    $camera="noprofil.jpg";
                $insert="INSERT INTO signup_student(Student_ID,name,reg_num,phone_num,email,ic_num,gender,parent_name,parent_num,address,room_num,block,sroom_type,password,capture,camera) VALUES('',' $name','$regnum','$phonenum','$email','$ic','$gender','$parentname','$parentnum','$address','$roomnum','$block','$room_type','$password','$text','$camera')";
                mysqli_query($conn, $insert);
                header('location:slogin.php');
            }
        }

    }
}
else{
    echo'<script>alert("No record in kamsis system!")</script>';
}
}
};

if(isset($_POST['sign_in'])){

   
    $ic=($_POST['ic']);
    $password=md5($_POST['password']);

    $select="SELECT * FROM signup_student WHERE ic_num='$ic' && password='$password'";

    $result =mysqli_query($conn,$select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $_SESSION['Student_ID']=$row['Student_ID'];
        $_SESSION['icnum']=$row['icnum'];
        $_SESSION['name']=$row['name'];
        $_SESSION['reg_num']=$row['reg_num'];
        $_SESSION['email']=$row['email'];
        $_SESSION['address']=$row['address'];
        $_SESSION['password']=$row['password'];
        $_SESSION['room_num']=$row['room_num'];
        $_SESSION['block']=$row['block'];
        $_SESSION['parent_name'] = $row['parent_name'];
        $_SESSION['phone_num']=$row['phone_num'];
        $_SESSION['parent_num'] = $row['parent_num'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['sroom_type']= $row['sroom_type'];
        $_SESSION['camera']= $row['camera'];
        $_SESSION['capture']= $row['capture'];
        $_SESSION['icnum']=$ic;
        header('location:shome.php');
    }else{
        echo'<script>alert("INCORRECT IC OR PASSWORD!")</script>';
        $error1[]='INCORRECT IC OR PASSWORD!';
        
    }
};

?>
<!DOCTYPE html>
<html>
<head>
	<title>SignUp and Login Student</title>
	<link rel="stylesheet" type="text/css" href="css/slogin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container" id="container">
<div class="form-container sign-up-container">
<div class="title">Create Account</div>
<?php

if (isset($error)){
    foreach($error as $error){
        echo '<span class="error-msg">'.$error.'</span>';
    };
};

?>
<form action="" method="post">
    <div class="user-details">
<div class="input-box">
        <video id="preview" width="100%"></video>
        <input type="hidden" name="text" id="text" readonyy="" placeholder="ID QRcode" class="form-control" required>
        </div> 
        
<div class="input-box">
        <input type="button" value="Scan Here " id="login-show" name="login-show" style="height:100px;">
</div>
        <div class="input-box">
            <span class="details">Full Name<a class="error" style="color:red;">*</a></span>
            
            <input type="text" placeholder="Enter Name"   name="name" required style="text-transform:uppercase;">
        </div>
        <div class="input-box">
            <span class="details">Reg Number<a class="error" style="color:red;">*</a></span>
            <input type="text" placeholder="Enter Reg No"  name="regnum" required style="text-transform:uppercase;">
        </div>
        <div class="input-box">
            <span class="details">Phone Number<a class="error" style="color:red;">*</a></span>
            <input type="number" placeholder="Enter Phone No"  name="phonenum" required>
        </div>
        <div class="input-box">
            <span class="details">Email<a class="error" style="color:red;">*</a></span>
            <input type="email" placeholder="Enter Email"  name="email" required>
        </div>
        <div class="input-box">
            <span class="details">IC Number<a class="error" style="color:red;">*</a></span>
            <input type="number" placeholder="Enter Ic.No"  name="ic" required>
        </div>
        <div class="input-box">
            <span class="details">Gender<a class="error" style="color:red;">*</a></span>
            <div class="custom_select">
                <select name="gender" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
        </div>
        <div class="input-box">
            <span class="details">Parent Name<a class="error" style="color:red;">*</a></span>
            <input type="text" placeholder="Enter Parent Name"  name="parentname" required style="text-transform:uppercase;">
        </div>
        <div class="input-box">
            <span class="details">Parent Number<a class="error" style="color:red;">*</a></span>
            <input type="number" placeholder="Enter Parent P.no" name="parentnum" required>
        </div>
        <div class="input-box">
            <span class="details">Address<a class="error" style="color:red;">*</a></span>
            <textarea class="textarea" name="address" required></textarea>
        </div>
        <div class="input-box">
            <span class="details"></span>
        </div>
        <div class="input-box">
            <span class="details">Room Number<a class="error" style="color:red;">*</a></span>
            <input type="number" placeholder="Enter Room Number" name="roomnum" required style="text-transform:uppercase;">
        </div>
        <div class="input-box">
            <span class="details">Block<a class="error">*</a></span>
            <div class="custom_select">
                <select name="block" id="selectA">
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
        <div class="input-box">
            <span class="details">Password<a class="error" style="color:red;">*</a></span>
            <input type="password" placeholder="Enter Password"  name="password" required>
        </div>
        <div class="input-box">
            <span class="details">Confirm Password<a class="error" style="color:red;">*</a></span>
            <input type="password" placeholder="Enter Confirm Password" name="confirmpass"  required>
        </div> 
    </div>
    <div class="btn">
        <input type="submit" value="Sign Up" name="sign_up">
    </div>
</form>

        <script>
            let scanner=new Instascan.Scanner({video: document.getElementById("preview")});
            $('#login-show').click(function(){
            Instascan.Camera.getCameras().then(function(cameras){
                if(cameras.length>0){
                    scanner.start(cameras[0]);
                } else{
                    ("No cameras found");
                }
            }).catch(function(e){
                console.error(e);
            });
        });
            scanner.addListener("scan",function(c){
                document.getElementById("text").value=c;
                alert("QR Code Inserted");
            });
        </script>
</div>
<div class="form-container sign-in-container">
	<form action="" method="post">
		<h1>Sign In</h1>
    <p></p>
    <?php

if (isset($error1)){
    foreach($error1 as $error1){
        echo '<span class="error-msg">'.$error1.'</span>';
    };
};

?>
	<input type="number" name="ic" placeholder="IC/No">
	<input type="password" name="password" placeholder="Password">
	<a class="txt1 "href="sforgot.php">Forgot Password ?</a>

    <div class="btn">

        <input type="submit" value=" Sign In          " name="sign_in">
    </div>
    </form>
</div>
<div class="overlay-container">
	<div class="overlay">
		<div class="overlay-panel overlay-left">
			<h1>Welcome To <br><span>iRH</span> System</br></h1>
			<p>To Keep Connected With Us Please Login With Your Personal Info</p>
			<button class="ghost" id="signIn">Sign In</button>
		</div>
		<div class="overlay-panel overlay-right">
			<h1>Welcome To <br><span>iRH</span> System</br></h1>
			<p>To Keep Connected With Us Please SignUp While not have an Account</p>
			<button class="ghost" id="signUp">Sign Up</button>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});
</script>


</body>
</html>