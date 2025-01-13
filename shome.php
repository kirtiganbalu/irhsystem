<?php
session_start();
if(!isset($_SESSION['icnum'])){
    header('location:slogin.php');
}

@include 'config.php';


    $select = " SELECT * FROM kwtask";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $row = mysqli_fetch_array($result);
      $_SESSION['task'] = $row['task'];
 
       }
      

?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Student HomePage</title>
        <link rel="stylesheet" href="css/shome.css">
        <script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous"></script>
        <script>
        $(function() {
        $(".toggle").on("click", function() {
            if ($(".item").hasClass("active")) {
                $(".item").removeClass("active");
            } else {
                $(".item").addClass("active");
            }
        });
    });
        </script>
    </head>
    <style>
    .design{
    display:flex;
    justify-content: space-around;
        gap: 10px;
  }
  .container {
    width: 37vmin;
    height: 30vmin;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    padding: 1em 0;
    position: relative;
    font-size: 18px;
    border-radius: 0.5em;
    background-color: #246368;
    border-bottom: 10px solid #188cf9;
  }
  
  i{
    color: #a5cfe3;
    font-size: 1.5em;
    text-align: center;
  
  }
  
  span.num {
    color: #fff;
    display: grid;
    place-items: center;
    font-weight: 600;
    font-size: 3em;
  }
  
  span.text {
    color: #5cd85a;
    font-size: 1.0em;
    text-align: center;
    pad: 0.7em 0;
    font-weight: 400;
    line-height: 0;
  }

        </style>
	<body onload="initClock()">
		<!--create HEADER PAGE-->
		<div class="header">
			<img src="PICTURES/poli_logo.png" alt="Logo">

			<h1>Return To Home System (iRHS)</h1>
		</div>
		<nav class="navbar">
    <input type="hidden" name="gender" value="<?php echo $_SESSION['gender'] ; ?>">
    <input type="hidden" name="warden_id" value="<?php echo $_SESSION['Student_ID']; ?>">
        <ul class="menu">
        <?php
                            require 'config.php';
                            $query = "SELECT * FROM signup_student WHERE Student_ID='".$_SESSION['Student_ID']."'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {

                                
                           

                                    ?>
        <img src="img/<?php echo $student['camera']; ?>"  class="user-pic" style="width:100px; border-radius:30%; cursor:pointer; margin-right:150px;">
            <?php
                                }}
            ?>
            <li class="logo" style="color:aliceblue; font-size:20px;">
            <div class="datetime">
      <div class="date">
        <span id="dayname">Day</span>,
        <span id="month">Month</span>
        <span id="daynum">00</span>,
        <span id="year">Year</span>
      </div>
      <div class="time">
        <span id="hour">00</span>:
        <span id="minutes">00</span>:
        <span id="seconds">00</span>
        <span id="period">AM</span>
      </div>
    </div></li>
            <li class="item"><a href="sapply.php">Apply</a></li>
            <li class="item"><a href="sstatus.php">Status</a></li>
            <li class="item"><a href="scontact.php">Contact Warden</a></li>
            <li class="item button"><a href="sprofile.php">Profile</a></li>
            <li class="item button secondary"><a href="slogoutdb.php">Log Out</a></li>
            <li class="toggle"><span class="bars"></span></li>
        </ul>
    </nav>
    <div class="marquee" name=updatetask>
    <div>
      <?php 
      $sql="SELECT task AS last_data FROM kwtask ORDER BY id_kwtask DESC";
      $result=mysqli_query($conn,$sql);
      $rows = mysqli_fetch_array($result);


      echo $rows['last_data'];
      ?>
      </div>
  </div>

		<!--create Content -->
        <div class="both-rows">
		<div class="column left-side" style="background-color:#EDBB99">
        <br></br>
        <div class="design">
        <div class="container">
    <i class="fab">Hostel Student</i>
      <?php
      $dash="SELECT * FROM tblasrama";
      $dahs_total=mysqli_query($conn,$dash);

      if($user=mysqli_num_rows($dahs_total))
      {
        echo '<span class="num" data-val="'.$user.'">000</span>';
      }else{
        echo '<span class="num" data-val="0">000</span>';
      }


      ?>
      <span class="text">Activated</span>
    </div>
        <div class="container">
    <i class="fab">Account Warden</i>
      <?php
      $dash="SELECT * FROM signup_warden";
      $dahs_total=mysqli_query($conn,$dash);

      if($user=mysqli_num_rows($dahs_total))
      {
        echo '<span class="num" data-val="'.$user.'">000</span>';
      }else{
        echo '<span class="num" data-val="0">000</span>';
      }


      ?>
      <span class="text">Activated</span>
    </div>
    <div class="container">
    <i class="fab">Account Student</i>
      <?php
      $dash="SELECT * FROM signup_student";
      $dahs_total=mysqli_query($conn,$dash);

      if($user=mysqli_num_rows($dahs_total))
      {
        echo '<span class="num" data-val="'.$user.'">000</span>';
      }else{
        echo '<span class="num" data-val="0">000</span>';
      }


      ?>
      <span class="text">Activated</span>
    </div>
    </div>
    <br>
    <br>
<h2><CENTER>ABOUT HOSTEL PSMZA</h2></CENTER><br></br>
				<p>Welcome To Hostel Residents To The Official Hostel Website. 
                                   This Site Was Developed To Make It Easier For Hostel Students To Know The Current Information Related 
                                   To The Activities Carried Out In Hostel.Apart From That, It Makes It Easier For Hostel Students To 
                                   Make Early Plans To Go In/Out On Hostel. Disciplinary Cases Will Also Be On Display For The Purpose 
                                   Of Self-Supervision And Observation Of Students. It Is Hoped That It Can Be Utilized From Time To Time. 
                                   Any Questions, Please Contact The Chief Warden For More Information.</p>
				<br>
				<br>
				<br>
                <br></br>
				<marquee behavior = "alternate"><h2>LETS SEE ACCOMMODATION IN HOSTEL PSMZA</h2></marquee>
				<div id ="menu" align="middle">
				<img class="mySlides w3-animate-fading" src="PICTURES/p1.JPG" style="width:55%">
                <img class="mySlides w3-animate-fading" src="PICTURES/p2.JPG" style="width:55%">
                <img class="mySlides w3-animate-fading" src="PICTURES/p3.JPG" style="width:55%">
                <img class="mySlides w3-animate-fading" src="PICTURES/p4.JPG"style="width:55%">
                <img class="mySlides w3-animate-fading" src="PICTURES/p6.JPEG"style="width:55%">
                <img class="mySlides w3-animate-fading" src="PICTURES/p9.JPG" style="width:55%">
				<img class="mySlides w3-animate-fading" src="PICTURES/p10.JPEG"style="width:55%">
        <img class="mySlides w3-animate-fading" src="PICTURES/p14.JPEG"style="width:55%">

				</div>
			</div>
		    <script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 850);    
}


let valueDisplays = document.querySelectorAll(".num");
let interval = 4000;

valueDisplays.forEach((valueDisplay) => {
  let startValue = 0;
  let endValue = parseInt(valueDisplay.getAttribute("data-val"));
  let duration = Math.floor(interval / endValue);
  let counter = setInterval(function () {
    startValue +=1;
    valueDisplay.textContent = startValue;
    if (startValue == endValue) {
      clearInterval(counter);
    }
  }, duration);
});
	
				
				
</script>
				<div class="column right-side" style="background-color:#F7DC6F">
<br></br>
<p><U><B>VISI HOSTEL PSMZA</p></U></B>
				<ul><br>
					<li>To Make Dormitory As A Conducive Accommodation Center In Producing Students
                                         Who Are Efficient And Excellent In The Field Of Curriculum And Co-Curriculum.</li>
					<br>
				</ul><br></br>
				 <p><U><B>MISI HOSTEL PSMZA</p></U></B>
				<ul>					<br>
					<li>Hostel Residents Are Working Together To Create A Safe, Peaceful And Comfortable Dormitory
                                         Atmosphere As A Harmonious Place To Live And Study.</li>
					<br>
				</ul><br></br>
                                <p><U><B>OBJECTIVE HOSTEL PSMZA</p></U></B>
				<ul>					<br>
					<li>1) Providing Comfortable And Safe Accommodation For Students.</li><br>
                                        <li>2) To Produce Skilled And Excellent Students.</li><br>
                                        <li>3) Fostering Leadership And Entrepreneurial Qualities Among Residents.</li><br>
                                        <li>4) Plan And Implement Related Activities.</li><br>
                                        <li>5) Ensuring An Efficient And Effective Management System.</li>
                </ul> <br></br>
                                <p><U><B>CONTACT INFORMATION</p></U></B>
				<ul>					<br>
				<li>While we're good with smoke signals, there are simpler ways for us to get in touch and answer your questions..</li>
				</ul>

                <br></br>
				<p><U><B> LOCATION HOSTEL</p></U></B>
				<ul>					<br>
			<li>Address: Pejabat Kamsis,Politeknik Sultan Mizan Zainal Abidin,KM 8 ,Jalan Paka 23000 Dungun, Terengganu.</li>
             </ul>		
		</div>
		
		

		</div>
	</body>
    <script type="text/javascript">
    function updateClock(){
      var now = new Date();
      var dname = now.getDay(),
          mo = now.getMonth(),
          dnum = now.getDate(),
          yr = now.getFullYear(),
          hou = now.getHours(),
          min = now.getMinutes(),
          sec = now.getSeconds(),
          pe = "AM";

          if(hou >= 12){
            pe = "PM";
          }
          if(hou == 0){
            hou = 12;
          }
          if(hou > 12){
            hou = hou - 12;
          }

          Number.prototype.pad = function(digits){
            for(var n = this.toString(); n.length < digits; n = 0 + n);
            return n;
          }

          var months = ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October", "November", "December"];
          var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
          var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
          var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
          for(var i = 0; i < ids.length; i++)
          document.getElementById(ids[i]).firstChild.nodeValue = values[i];
    }

    function initClock(){
      updateClock();
      window.setInterval("updateClock()", 1);
    }
</script>
	
</html>