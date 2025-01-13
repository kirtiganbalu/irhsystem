<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:wlogin.php');
}?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Kemaskini</title>
        <link rel="stylesheet" href="css/kwhome.css">
        <script src="js/jquery-3.5.1.js"></script> 
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
    * {
	box-sizing: border-box;
}

body {
	display: flex;
	justify-content: center;
	align-items: center;
	flex-direction: column;
	font-family: 'Montserrat', sans-serif;
}
.container {

	border-radius: 10px;
  	box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
			0 10px 10px rgba(0,0,0,0.22);
	position: relative;
	background: -webkit-linear-gradient(to right, #d8cbc4, #8b6c5c);
	background: linear-gradient(to right, #d8cbc4, #8b6c5c);
	background-position: center;
	background-repeat:no-repeat;
	text-align: center;
    background-size:cover;
    padding: 40px;



}
.container1 {

border-radius: 10px;
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
        0 10px 10px rgba(0,0,0,0.22);
position: relative;
background: -webkit-linear-gradient(to right, #d8cbc4, #8b6c5c);
background: linear-gradient(to right, #d8cbc4, #8b6c5c);
background-position: center;
background-repeat:no-repeat;
text-align: left;
background-size:cover;
padding: 40px;



}
.btn{
    display: flex;
    align-items: center;
    justify-content: center;
}
.btn button{
    border-radius: 20px;
	border: 1px solid #3BB9FF;
	background-color: #3BB9FF;
	color: #FFFFFF;
	font-size: 12px;
	font-weight: bold;
	padding: 15px 45px;
	letter-spacing: 1px;
	text-transform: uppercase;
	transition: transform 80ms ease-in;

}
.btn button:active {
	transform: scale(0.95);
}
.btn button:focus {
	outline: none;
}
.btn button:hover{
	background-color:green;
    border:  1px solid green;
}
    </style>
    <body>
        <form  class=container>
        <h1>Kemaskini Data Pelajar</h1>

        <div class=container1>
        <div class="btn">
        <button type="button" class="btn btn-primary mt-3 btnupdatedatapelajar"><i class="fa fa-retweet"></i> Klik / Tap Untuk Kemaskini</button>
</div>
<div class="updatestudentcontentsect mt3"></div>

<script>
    $(".btnupdatedatapelajar").click(function(){
    $(".updatestudentcontentsect").prepend('<i class="fa fa-cog fa-spin"></i> Mengemaskini. May take a while...');
    $(".updatestudentcontentsect").load('getdata.php');
});	
</script>
</div> 
        </form>
        <br>

        <form action="kwhome.php" class="btn">
      <button type="submit" name="task_back" style="background-color:red;">BACK</button>
      </form>
    </body>
</html>

