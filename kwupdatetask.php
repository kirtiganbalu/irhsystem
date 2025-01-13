<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['admin_id'])){
  header('location:wlogin.php');
}

if(isset($_POST['task_sub'])){
  $task=($_POST['task']);
  $kw_id=($_POST['kw_id']);

  $insert="INSERT INTO kwtask(id_kwtask,task,kw_id) VALUES('','$task','$kw_id')";
  mysqli_query($conn, $insert);
  $error[]='Data Inserted!';
}


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Update Task</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/kwupdatetask.css">
  </head>
  <body>
    <form action="" method="post">
    <input type="hidden" name="kw_id" value="<?php echo $_SESSION['Warden_ID']; ?>">
      <h1>Update This Week Warden Task</h1>
      <div class="formcontainer">
      <hr/>
      <div class="container1">
        <label for="uname"><strong>Update Message</strong></label>
        <br>
        </div>
     <?php

if (isset($error)){
    foreach($error as $error){
        echo '<span class="error-msg">'.$error.'</span>';
    };
};

?><br>
        <textarea name="task"></textarea>
        <br>

        </div>
        <div class="container2">
      <button type="submit" name="task_sub">UPDATE TASK</button>
    </form>
    <form action="kwhome.php" >
      <button type="submit" name="task_back" style="background-color:red;">BACK</button>
      </form>
  </body>
</html>