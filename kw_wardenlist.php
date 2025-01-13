<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:wlogin.php');
}
if(isset($_POST['delete_warden'])){

    $warden_id=mysqli_real_escape_string($conn,$_POST['delete_warden']);

    $query="DELETE FROM signup_warden WHERE Warden_ID='$warden_id'";
    $query_run=mysqli_query($conn,$query);

    if($query_run)
    {
        echo'<script>alert("Data Deleted!")</script>';
        $error[]='Data Deleted!';
    }else{
        echo'<script>alert("Data Not Deleted!")</script>';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>List Warden</title>
    
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<style>
    .card .error-msg{
	margin:10px 0;
	display: block;
	background:red;
	color: rgb(11, 11, 11);
	border-radius: 5px;
	font-size: 20px;
	padding:14px;


}
    body{
    background-color:lavenderblush;
    font-family: sans-serif;
    }
    .card-header{
        text-align: center;
    }
    .viewStudentBtn{
        width:80px;
        height: 30px;
    }
    .viewStudentBtn:hover{
    background-color: #2beb11;
    border-color:  #2beb11;
    color: black;
    }
    @media screen and  (max-width:768px){
    .table thead{
        display:none;
    }
    .table, .table tbody, .table tr, .table td{
        display:block;
        width:100%;

    }
    .table tr{
        margin-bottom: 15px;

    }
    .table tbody tr td{
        text-align: right;
        padding-left: 50%;
        position: relative;

    }
    .table td:before{
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 15px;
        font-weight: 600;
        font-size: 14px;
        text-align: left;


    }

}
.btn-block {
    display: block;
    background-color: aqua;
    width: 100%;
    padding: 0.4rem 1.3rem;
    font-size: 1rem;
    margin-right: 0.5rem;
    cursor: pointer;
    border: none;
    outline: none;
    transition: opacity 1s ease-in-out;
    border-radius: 3px;
  }
  .btn-block2 {
    display: block;
    background-color: rgb(219, 31, 31);
    width: 100%;
    padding: 0.4rem 1.3rem;
    font-size: 1rem;
    margin-right: 0.5rem;
    cursor: pointer;
    border: none;
    outline: none;
    transition: opacity 1s ease-in-out;
    border-radius: 3px;
  }
  .text-primary{
    color: darkcyan;
  }
  .btn-block:hover{
    background-color: #c2ae53;
  }
  .btn-block2:hover{
    background-color: #c06e6e;
  }
  .btn-block {
    display: block;
    background-color: aqua;
    width: 100%;
    color:black;
    padding: 0.4rem 1.3rem;
    font-size: 1rem;
    margin-right: 0.5rem;
    cursor: pointer;
    border: none;
    outline: none;
    transition: opacity 1s ease-in-out;
    border-radius: 3px;
  }
  .btn-block2 {
    display: block;
    background-color: rgb(219, 31, 31);
    width: 100%;
    color:black;
    padding: 0.4rem 1.3rem;
    font-size: 1rem;
    margin-right: 0.5rem;
    cursor: pointer;
    border: none;
    outline: none;
    transition: opacity 1s ease-in-out;
    border-radius: 3px;
  }
  .text-primary{
    color: darkcyan;
  }
  .btn-block:hover{
    background-color: #c2ae53;
  }
  .btn-block2:hover{
    background-color: #c06e6e;
  }


</style>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <?php

if (isset($error)){
    foreach($error as $error){
        echo '<span class="error-msg">'.$error.'</span>';
    };
};

?>
                <div class="card-header">
                    <h4> WARDEN LIST
                        <form action="kwhome.php">
                        <button type="submit" class="btn btn-primary float-end">
                            Back
                        </button>
                        </form>
                    </h4>
                    <form action="kw_addwarden.php" >
                        <button type="submit" class="btn btn-primary float-start" >
                            Add Warden
                        </button>
                        </form>
                        <a href="https://api.telegram.org/bot5479285209:AAHHUWV9i7NrIvgUpPN0rHbHQF8VhnrnAzI/getUpdates">
                        <button type="submit" class="btn btn-primary float-middle">
                        link tele
                        </button></a>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>ID Number</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>User Type</th>
                                <th>Block</th>
                                <th>Room Type</th>
                                <th>Register Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'config.php';

                            $i=1;
                            $query = "SELECT * FROM signup_warden";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $warden)
                                {
                                    if($warden['user_type']=="Warden")
                                    {

                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?= $warden['Name'] ?></td>
                                        <td><?=$warden['id_num'] ?></td>
                                        <td><?= $warden['phone_num'] ?></td>
                                        <td><?= $warden['email'] ?></td>
                                        <td><?= $warden['gender'] ?></td>
                                        <td><?= $warden['user_type'] ?></td>
                                        <td><?= $warden['block'] ?></td>
                                        <td><?= $warden['Room_Type'] ?></td>
                                        <td><?= $warden['Id_wcreated'] ?></td>
                                        <?php
                                            $_SESSION['ID']=$warden['Warden_ID'];
                                            ?>
                                        <td>
                                            <a href="kw_wardenedit.php?id=<?= $warden['Warden_ID'] ?>" class="btn btn-info btn-sm">Edit</a>
                                        <form action="#" method="POST" class="d-inline">
                                            <button type="submit" name="delete_warden" value="<?= $warden['Warden_ID'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </fomr>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                
                                    }     
                            }
                        }
                            ?>
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>