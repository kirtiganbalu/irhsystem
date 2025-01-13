<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:wlogin.php');
}
if(isset($_POST['delete_student'])){

    $student_id=mysqli_real_escape_string($conn,$_POST['delete_student']);

    $query="DELETE FROM signup_student WHERE Student_ID='$student_id'";
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student List</title>


  <script src="js/jquery-3.5.1.js"></script> 
  <script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready( function () {
    $('#myDataTable').DataTable();
} );

  </script>

      <!-- Required meta tags -->
      <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Warden List</title>
    
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

</head>
<body>
<style>
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

.card .error-msg{
	margin:10px 0;
	display: block;
	background:red;
	color: rgb(11, 11, 11);
	border-radius: 5px;
	font-size: 20px;
	padding:14px;


}

</style>
<body>
<!-- View Student Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Status Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Account Created</label>
                    <p id="view_applydate" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_name" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Reg Number</label>
                    <p id="view_reg" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Phone Number</label>
                    <p id="view_phone" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <p id="view_email" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">IC Number</label>
                    <p id="view_ic" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Gender</label>
                    <p id="view_gender" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Parent Name</label>
                    <p id="view_parent_name" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Parent Number</label>
                    <p id="view_parent_number" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                    <p id="view_address" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Room Number</label>
                    <p id="view_room" class="form-control"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

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
                    <h4> STUDENT LIST
                        <form action="kwhome.php">
                        <button type="submit" class="btn btn-primary float-end">
                            Back
                        </button>
                        </form>
                    </h4>
                </div>
                <div class="card-body">

                    <table id="myDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Matric Number</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>ID Number</th>
                                <th>Gender</th>
                                <th>Room Number</th>
                                <th>Block</th>
                                <th>Account Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'config.php';

                            $i=1;
                            $query = "SELECT * FROM signup_student";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {
                                   

                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?= $student['name'] ?></td>
                                        <td><?=$student['reg_num'] ?></td>
                                        <td><?= $student['phone_num'] ?></td>
                                        <td><?= $student['email'] ?></td>
                                        <td><?=$student['ic_num'] ?></td>
                                        <td><?= $student['gender'] ?></td>
                                        <td><?= $student['room_num'] ?></td>
                                        <td><?= $student['block'] ?></td>
                                        <td><?= $student['Id_screated'] ?></td>
                                        <?php
                                            $_SESSION['ID']=$student['Student_ID'];
                                            ?>
                                        <td>
                                            <button type="button" value="<?=$student['Student_ID'];?>" class="viewStudentBtn btn btn-info btn-sm">View</button>
                                            <form action="#" method="POST" class="d-inline">
                                            <button type="submit" name="delete_student" value="<?=$student['Student_ID'];?>" class="btn btn-danger btn-sm">Delete</button>  
                                            </form>   
                                        </td>
                                    </tr>
                                    <?php $i++;
                                
                                         
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        

        $(document).on('click', '.viewStudentBtn', function () {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code1.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_name').text(res.data.name);
                        $('#view_reg').text(res.data.reg_num);
                        $('#view_phone').text(res.data.phone_num);
                        $('#view_email').text(res.data.email);
                        $('#view_ic').text(res.data.ic_num);  
                        $('#view_gender').text(res.data.gender);
                        $('#view_parent_name').text(res.data.parent_name);
                        $('#view_parent_number').text(res.data.parent_num);
                        $('#view_address').text(res.data.address);
                        $('#view_room').text(res.data.room_num);
                        $('#view_applydate').text(res.data.Id_screated);

                        $('#studentViewModal').modal('show');
                    }
                }
            });
        });

       
    </script>
</body>
</html>