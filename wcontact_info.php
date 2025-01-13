<?php
session_start();
@include 'config.php';
if(!isset($_SESSION['admin_id'])){
    header('location:wlogin.php');
}

if(isset($_POST['View']))
{
    $Status="Done View";
    $ID=$_POST['ID'];
    

    $query="UPDATE contact_warden set status='$Status' WHERE id_contact='$ID'";
    $res=mysqli_query($conn,$query);

    if($res){
        echo'<script>alert("Data Inserted!")</script>';
    }else{
        echo'<script>alert("Data Not Inserted!")</script>';
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Contact Info</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<style>
    body{
    background-color: #c2ae53;
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
    .table, .table tbody,table thead, .table tr, .table td{
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
<input type="hidden" name=ID value="<?php echo $_SESSION['Warden_ID'];  ?>">
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4> REQUEST LIST
                        <style>
                            .float-start{
                                margin-left: 20px;
                            }
                            </style>
                        <form action="whome.php">
                        <button type="submit" class="btn btn-primary float-end">
                            Back
                        </button>
                        </form>

                        <form action="wmsgview.php">
                        <button type="submit" class="btn btn-primary float-start">
                            View List
                        </button>
                        </form>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Matric Number</th>
                                <th>Block</th>
                                <th>Room Number</th>
                                <th>Phone Number</th>
                                <th>Message</th>
                                <th>Message Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'config.php';

                            $i=1;
                            $query = "SELECT * FROM contact_warden WHERE Warden_ID='".$_SESSION['Warden_ID']."'";
                            $query_run = mysqli_query($conn, $query);
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {
                                    if($student['status']=="Pending"){
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?= $student['name'] ?></td>
                                        <td><?=$student['Matric_no'] ?></td>
                                        <td><?= $student['block'] ?></td>
                                        <td><?= $student['Room_no'] ?></td>
                                        <td><?= $student['phone'] ?></td>
                                        <td><?= $student['message'] ?></td>
                                        <td><?= $student['time_message'] ?></td>
                                        <form action="" method="post">
                                        <input type="hidden" name=ID value="<?php echo $student['id_contact']; ?>">
                                        <td><input type="submit" name="View" class="btn btn-block btn-primary" value="View"/>
                                        </form></td>
                                        
                                        
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