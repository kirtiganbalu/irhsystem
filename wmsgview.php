<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:wlogin.php');
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
    <title>Contact View List</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<style>
    body{
    background-color:beige;
    font-family: sans-serif;
    }
    .card-header{
        text-align: center;
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



</style>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4> VIEW LIST
                        <style>
                            .float-start{
                                margin-left: 20px;
                            }
                            </style>
                        <form action="wcontact_info.php">
                        <button type="submit" class="btn btn-primary float-end">
                            Back
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
                            $query = "SELECT * FROM contact_warden WHERE Warden_ID='".$_SESSION['Warden_ID']."' order by id_contact DESC ";
                            $query_run = mysqli_query($conn, $query);
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {
                                    if($student['status']=="Done View"){
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
                                        <td><?= $student['status'] ?></td>
                                        
                                        
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