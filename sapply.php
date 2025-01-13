<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['icnum'])){
    header('location:slogin.php');
}

 if(isset($_POST['text'])){

    $text =$_POST['text'];


$select = " SELECT * FROM signup_student WHERE capture='$text' ";

$result = mysqli_query($conn, $select);

if(mysqli_num_rows($result)>0){
    $name=($_POST['Name1']);
    $IC=($_POST['IC']);
    $Reg=($_POST['Reg']);
    $Check_Out=($_POST['Check_Out']);
    $Check_In=($_POST['Check_In']);
    $gender=($_POST['gender']);
    $block=($_POST['block']);
    $roomno=($_POST['roomno']);
    $sphone=($_POST['sphone']);
    $Pphone=($_POST['Pphone']);
    $Transportation=($_POST['Transportation']);
    $dAddress=($_POST['dAddress']);
    $Reason=($_POST['Reason']);
    $Student_ID=($_POST['Student_ID']);
    $Status="Pending";
    $Comment="Pending";


    if($text != $IC)
    {
        echo'<script>alert("QR CODE NOT MATCHED!")</script>';
        $error1[]='QR CODE NOT MATCHED!';

    }elseif($name != $_SESSION['name']){
        echo'<script>alert("NAME NOT MATCHED!")</script>';
        $error1[]='NAME NOT MATCHED!';
    }elseif($Reg != $_SESSION['reg_num']){
        echo'<script>alert("REGISTER NUMBER NOT MATCHED!")</script>';
        $error1[]='REGISTER NUMBER NOT MATCHED!';
        
    }elseif($block != $_SESSION['block']){
        echo'<script>alert("BLOCK NOT MATCHED!")</script>';
        $error1[]='BLOCK NOT MATCHED!';
    }
    
    elseif($roomno != $_SESSION['room_num']){
        echo'<script>alert("ROOM NUMBER NOT MATCHED!")</script>';
        $error1[]='ROOM NUMBER NOT MATCHED!';
    }
    elseif($sphone != $_SESSION['phone_num']){
        echo'<script>alert("PHONE NUMBER NOT MATCHED!")</script>';
        $error1[]='PHONE NUMBER NOT MATCHED!';
    }
    elseif($Pphone != $_SESSION['parent_num']){
        echo'<script>alert("PARENT PHONE NUMBER NOT MATCHED!")</script>';
        $error1[]='PARENT PHONE NUMBER NOT MATCHED!';
    }
    
    else{
        $warden=($_POST['warden']);
        $sroom_type=($_POST['sroom_type']);
        $room_type=($_POST['room_type']);
        if($sroom_type !== $room_type)
        {
            echo'<script>alert("Room Type Not Matched!")</script>';
            $error1[]='Room Type Not Matched!';
        }
        else{
        $insert="INSERT INTO sapplydb(ID,Name,IC_number,Reg_number,Check_out,Check_in,Gender,Block,Warden_ID,Room_num,Phone_num,Parent_number,Transport_detail,Destination_add,Reason,Student_ID,Status,Comment) VALUES('',' $name','$IC','$Reg','$Check_Out','$Check_In','$gender','$block','$warden','$roomno','$sphone','$Pphone','$Transportation','$dAddress','$Reason','$Student_ID','$Status','$Comment')";
        mysqli_query($conn, $insert);
        header('location:shome.php');
        }

    }
  
}else{
    echo'<script>alert("QR CODE NOT MATCHED!")</script>';
   $error1[] = 'QR CODE NOT MATCHED!';
}

};
?>
<!DOCTYPE html>
<html>
<head>
	<title>Apply form</title>
	<link rel="stylesheet" type="text/css" href="css/sapply.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<BR></BR><BR></BR>
<div class="container" id="container">
<div class="form-container sign-up-container">
<div class="title">Information Of Request</div>
<?php

if (isset($error1)){
    foreach($error1 as $error1){
        echo '<span class="error-msg">'.$error1.'</span>';
    };
};

?>
<form action="#" method="post">
    <div class="user-details">
        <input type="hidden" name="Student_ID" value="<?php echo $_SESSION['Student_ID']; ?>">
        <input type="hidden" name="sroom_type" value="<?php echo $_SESSION['sroom_type']; ?>">
        <div class="input-box">
            <span class="details">Name<a class="error">*</a></span>
            <input type="text" value="<?php echo $_SESSION['name'];?>" Name="Name1" id="Name1" style="text-transform:uppercase;">
            
        </div>
        <div class="input-box">
            <span class="details">IC Number<a class="error">*</a></span>
            <input type="number" value="<?php echo $_SESSION['icnum'];?>" Name="IC" id="IC" required>
        </div>
        <div class="input-box">
            <span class="details">Registration Number<a class="error">*</a></span>
            <input type="text" value="<?php echo $_SESSION['reg_num'];?>" Name="Reg" id="Reg" style="text-transform:uppercase;" required >
        </div>
        <div class="input-box">
            <span class="details">Gender<a class="error">*</a></span>
            <div class="custom_select">
                <select name="gender" id="gender"  required>
                <option value="<?php echo $_SESSION['gender']; ?>"><?php echo $_SESSION['gender']; ?></option>
                </select>
            </div>
        </div>
        <div class="input-box">
            <span class="details">Check Out Date<a class="error">*</a></span>
            <input type="date" placeholder="Check Out" Name="Check_Out" id="Check_Out" required>
        </div>
        <div class="input-box">
            <span class="details">Check In Date<a class="error">*</a></span>
            <input type="date" placeholder="Check In" Name="Check_In"  id="Check_In" required>
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
        <div class="input-box">
            <span class="details">Room Number<a class="error">*</a></span>
            <input type="text" value="<?php echo $_SESSION['room_num'];?>" name="roomno" id="roomno"  style="text-transform:uppercase;" required>
           
        </div>
        <div class="input-box">
            <span class="details">Block<a class="error">*</a></span>
            <div class="custom_select">
                <select name="block" id="selectA" onchange="my_fun(this.value);" required>
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

        <script>
            function my_fun2(str){
                if (window.XMLHttpRequest){
                    xmlhttp=new XMLHttpRequest();
                }else{
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function(){
                    if (this.readyState==4 && this.status==200){
                        document.getElementById('poll2').innerHTML=this.responseText;
                    }
                }
                xmlhttp.open("GET","helper2.php?value="+str, true);
                xmlhttp.send();
            }
        </script>

        <div class="input-box">
            <span class="details">Warden Name<a class="error">*</a></span>
            <div class="custom_select" id="poll" name="warden">
                <select onchange="my_fun2(this.value);" id="wname" required>
                    <option>select warden</option>
                </select>
            </div>
        </div>
        <div class="input-box">
            <span class="details">Room Type<a class="error">*</a></span>
            <div class="custom_select" id="poll2" name="room_type" required>
                <select id="room_type" required>
                    <option>Room Type</option>
                </select>
            </div>
        </div>
        <div class="input-box">
            <span class="details">Phone Number<a class="error">*</a></span>
            <input type="number" value="<?php echo $_SESSION['phone_num'];?>" name="sphone" id="sphone" required >
            
        </div>
        <div class="input-box">
            <span class="details">Parent Phone Number<a class="error">*</a></span>
            <input type="number" value="<?php echo $_SESSION['parent_num'];?>" name="Pphone" id="Pphone" required>
           
        </div>
        <div class="input-box">
            <span class="details">Destination Address<a class="error">*</a></span>
            <textarea class="textarea" Name="dAddress" id="dAddress" required></textarea>
            
        </div>
        <div class="input-box">
            <span class="details">Reason<a class="error">*</a></span>
            <textarea class="textarea" Name="Reason" id="Reason" required></textarea>
            
        </div>
        <div class="input-box">
            <span class="details">Transportation Details<a class="error">*</a></span>
            <input type="text" placeholder="Transportation" name="Transportation" id="Transportation" required>
          
        </div>
    </div>
    <div class="btn">
        <input type="button" value="Submit" name="login-show" id="login-show1">
        <a href="shome.php">
            <div class="btn1"><input class="btn1" type="button" value="Back"></div></a>
    </div>



    <div id="login-modal">
    <div class="modal">
      <div class="top-form">
        <div class="close-modal">
          &#10006;
        </div>
      </div>
      <div class = "login-form">
        <h2>SCAN QR CODE MATRIC</h2>
        <form action="#"  >
        <div class="input-box">
            <video id="preview1" width="100%"></video>
            <input type="hidden" name="text" id="text" readonyy="" placeholder="ID QRcode" class="form-control" >
            <br></br><br></br>
            <div class="btn">
        <input type="button" value="Scan Here" name="login-show" id="login-show">
        </div>
        <div class="btn" style="margin:10px;">
        <input class="btn" type="submit" value="Submit" name="btn">
    </div>
    
        </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(function() {

      $('#login-show1').click(function() {
        $('#login-modal').fadeIn().css("display", "flex");
      });

      $('.close-modal').click(function() {
        $('#login-modal').fadeOut();
      });
    });
  </script>
</form>
<script>
    let scanner=new Instascan.Scanner({video: document.getElementById("preview1")});
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
        alert("SCAN DONE");
        document.submit(irhsbot());

    });
</script>

<script>
    var telegram_bot_id = "5479285209:AAHHUWV9i7NrIvgUpPN0rHbHQF8VhnrnAzI";
//chat id

//var chat_id = 1477991885;
//var chat_id = 861135710;
var name, ic, reg,checkin, checkout, gender,block, wardenname, roomno,studentno, parentno, transportation,adress, reason;
var ready = function () {
    tele = document.getElementById("tele").value;
    name = document.getElementById("Name1").value;
    ic = document.getElementById("IC").value;
    reg = document.getElementById("Reg").value;
    gender = document.getElementById("gender").value;
    checkout = document.getElementById("Check_Out").value;
    checkin = document.getElementById("Check_In").value;
    roomno = document.getElementById("roomno").value;
    
    block = document.getElementById("selectA").value;
    wardenname = document.getElementById("wname").value;
    roomtype = document.getElementById("room_type").value;
    
    studentno = document.getElementById("sphone").value;
    parentno = document.getElementById("Pphone").value;
    adress = document.getElementById("dAddress").value;
    reason = document.getElementById("Reason").value;
    transportation = document.getElementById("Transportation").value;

    message = "Name: " + name + "\nIc: " + ic + "\nRegistration Number: " + reg+ "\nGender: " + gender+  "\nCheck Out: " + checkout+ "\nCheck In: " + checkin+ "\nRoom Numbere: " +roomno + "\nBlock: " + block+ "\nWarden Name: " +wardenname + "\nRoom type:"+roomtype+  "\nStudent Number: " +studentno + "\nParent Number: " +parentno + "\nAddress: " +adress + "\nReason: " +reason+ "\nTransportation: " +transportation  ;
};
var irhsbot = function () {
    ready();
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.telegram.org/bot" + telegram_bot_id + "/sendMessage",
        "method": "POST",
        "headers": {
            "Content-Type": "application/json",
            "cache-control": "no-cache"
        },
        "data": JSON.stringify({
            "chat_id": tele,
            "text": message
        })
    };
    $.ajax(settings).document.forms[0].submit().done(function (response) {
        console.log(response);
    });
    
    document.getElementById("Name1").value = "";
    document.getElementById("IC").value = "";
    document.getElementById("Reg").value = "";
    document.getElementById("gender").value = "";
    document.getElementById("Check_Out").value = "";
    document.getElementById("Check_In").value = "";
    document.getElementById("roomno").value = "";
    
    
    document.getElementById("selectA").value = "";
    document.getElementById("wname").value = "";
    document.getElementById("room_type").value="";
    
    document.getElementById("sphone").value = "";
    document.getElementById("Pphone").value = "";
        document.getElementById("dAddress").value = "";
    document.getElementById("Reason").value = "";
    document.getElementById("Transportation").value = "";

    return false;
};



</script>
</div>
</div>
</body>
</html>