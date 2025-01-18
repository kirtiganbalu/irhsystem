<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<title>IRHS SYSTEM</title>
	<link rel="stylesheet" type="text/css" href="css/index.css"><!--index page css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container" id="container">
<div class="form-container warden-container">

    <form action="wlogin.php"><!--WARDEN login page-->
		<h1>ACCESS WARDEN</h1>
	<button>LET'S GO</button>
	</form>
</div>
<div class="form-container student-container">
    <form action="slogin.php"><!--student login page-->
        <h1>ACCESS STUDENT</h1>
        <button>LET'S GO</button>
    </form>
</div>
<div class="overlay-container">
	<div class="overlay">
		<div class="overlay-panel overlay-left">
			<h1>Welcome To <br><span>iRH</span> System</br></h1>
			<p>To Keep Connected With Us</p>
			 <P>IF YOU ARE STUDENT CLICK LEFT</P>
			<button class="ghost" id="signIn">LEFT</button>
		</div>
		<div class="overlay-panel overlay-right">
			<h1>Welcome To <br><span>iRH</span> System</br></h1>
			<p>To Keep Connected With Us</p>
			<P>IF YOU ARE WARDEN CLICK RIGHT</P>
			<button class="ghost" id="signUp">RIGHT</button>
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