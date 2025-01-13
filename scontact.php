<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['icnum'])){
    header('location:slogin.php');
}

 if(isset($_POST['send'])){

	$name=$_POST['name'];
	$matric=$_POST['matric'];
	$phone=$_POST['phone'];
	$roomno=$_POST['roomno'];
	$block=$_POST['block'];
	$message=$_POST['message'];
	$Student_ID=$_POST['Student_ID'];
	$warden=($_POST['warden']);
	$status="Pending";
    
        $insert="INSERT INTO contact_warden(id_contact,Student_ID,name,Warden_ID,Matric_no,Room_no,block,phone,message,status) VALUES('','$Student_ID',' $name','$warden','$matric','$roomno','$block','$phone','$message','$status')";
        $res=mysqli_query($conn, $insert);

		if($res){
			echo'<script>alert("Message Sending!")</script>';
		}else{
			echo'<script>alert("Message Not Sending!")</script>';
		}
        };
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact Warden</title>
	<link rel="stylesheet" type="text/css" href="css/scontact.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
</head>
<body>
	<form action="" method="post">

	<input type="hidden" name="Student_ID" value="<?php echo $_SESSION['Student_ID']; ?>">
        <input type="hidden" name="sroom_type" value="<?php echo $_SESSION['sroom_type']; ?>">
	<div class="container">
		<div class="contact-box">
			<div class="left"></div>
			<div class="right">
				<h2>Contact Us</h2>
				<input name="name" type="text" class="field" value="<?php echo $_SESSION['name'];?>">
				<input name="matric" type="text" class="field" value="<?php echo $_SESSION['reg_num'];?>">
				<input name="phone" type="number" class="field" value="<?php echo $_SESSION['phone_num'];?>">
                <div class="field">
					<input type="text" class="field" placeholder="Room Number" value="<?php echo $_SESSION['room_num'];?>" name="roomno">
				   
				</div>
				<div class="field">
					<span class="details">Block<a class="error">*</a></span>
					<div class="field">
						<select class="field" name="block" id="selectA" onchange="my_fun(this.value);" required>
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
				<div class="field">
					<span class="details">Warden Name<a class="error">*</a></span>
					<div class="field" id="poll" name="warden">
						<select class="field" required>
							<option>select warden</option>
						</select>
					</div>
				</div>
				<textarea name="message" placeholder="Message" class="field" required></textarea>
				<button name="send" type="submit" class="btn" style="margin:10px;">Send</button>

				<a href="studrecordcontact.php"><button name="view" type="button" class="btn3" style="margin:10px;">View Message</button></a>
				<a href="shome.php"><button name="back" type="button" class="btn1" style="margin:10px;">Back</button></a>
			</div>
		</div>
	</div>

<script>
	function my_fun(str){
		if (window.XMLHttpRequest){
			xmlhttp=new XMLHttpRequest();
		}else{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (this.readyState==4 && this.status==200){
				document.getElementById('poll').innerHTML=this.responseText;
			}
		}
		xmlhttp.open("GET","helper.php?value="+str, true);
		xmlhttp.send();
	}
</script>
</form>
</body>
</html>