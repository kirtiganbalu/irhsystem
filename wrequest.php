<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:wlogin.php');
}

if(isset($_POST['Approve']))
{
    $Status="Approved";
    $Comment=$_POST['Comment'];
    $ID=$_POST['ID'];
    

    $query="UPDATE sapplydb set Status='$Status', Comment='$Comment' WHERE ID='$ID'";
    $res=mysqli_query($conn,$query);

    if($res){
        echo'<script>alert("Data Inserted!")</script>';
    }else{
        echo'<script>alert("Data Not Inserted!")</script>';
    }
}
if(isset($_POST['Reject']))
{
    $Status="Reject";
    $Comment=$_POST['Comment'];
    $ID=$_POST['ID'];

    $query="UPDATE sapplydb set Status='$Status', Comment='$Comment' WHERE ID='$ID'";
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
    <title>Request List</title>

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
<!-- View Student Modal -->
<div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Student Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">
                <input type="hidden" name=ID value="<?php echo $_SESSION['Warden_ID'];  ?>">
                <div class="mb-3">
                    <label for="">Apply Date</label>
                    <p id="view_applydate" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_name" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">IC Number</label>
                    <p id="view_ic" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Reg Number</label>
                    <p id="view_reg" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Check Out Date</label>
                    <p id="view_checkout" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Check In Date</label>
                    <p id="view_checkin" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Gender</label>
                    <p id="view_gender" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Block</label>
                    <p id="view_block" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Room Number</label>
                    <p id="view_room" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Phone number</label>
                    <p id="view_phone" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Parent Number</label>
                    <p id="view_parent" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Transport Detail</label>
                    <p id="view_transport" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Destination Address</label>
                    <p id="view_destination" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Reason</label>
                    <p id="view_reason" class="form-control"></p>
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
                    </h4>
                    <form action="wapprovelist.php" >
                        <button type="submit" class="btn btn-primary float-start" style="background-color:#2beb11; border-color: #2beb11;" >
                            Approval List
                        </button>
                        </form>
                        
                        <form action="wrejectlist.php" >
                        <button type="submit" class="btn btn-primary float-start" style="background-color:crimson; border-color:crimson;" >
                            Reject List
                        </button>
                        </form>
                </div>
                <div class="card-body">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Matric Number</th>
                                <th>Check Out Date</th>
                                <th>Check In Date</th>
                                <th>Room Number</th>
                                <th>Reason</th>
                                <th>Apply Date</th>
                                <th>Status</th>
                                <th>View Details</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'config.php';

                            $i=1;
                            $query = "SELECT * FROM sapplydb WHERE Warden_ID='".$_SESSION['Warden_ID']."'";
                            $query_run = mysqli_query($conn, $query);
                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {
                                    if($student['Status']=="Pending"){
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?= $student['Name'] ?></td>
                                        <td><?=$student['Reg_number'] ?></td>
                                        <td><?= $student['Check_out'] ?></td>
                                        <td><?= $student['Check_in'] ?></td>
                                        <td><?= $student['Room_num'] ?></td>
                                        <td><?= substr($student['Reason'],0,30) ?></td>
                                        <td><?= $student['sapply_date'] ?></td>
                                        <td><?= $student['Status'] ?></td>
                                        
                                        <td>
                                            <button type="button" value="<?=$student['ID'];?>" class="viewStudentBtn btn btn-info btn-sm">View</button>
                                             </td>
                                        <td>
                                        <form action="" method="post">
                                        <textarea  name="Comment"></textarea>
                                        </td>
                                        <input type="hidden" name=ID value="<?php echo $student['ID']; ?>">
                                        <td><input type="submit" name="Approve" class="btn btn-block btn-primary" value="Approve"/>
                                        <br>
                                        <input type="submit" name="Reject" class="btn btn-block2 btn-primary" value="Reject"/>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        

        $(document).on('click', '.viewStudentBtn', function () {

            var student_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?student_id=" + student_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_name').text(res.data.Name);
                        $('#view_ic').text(res.data.IC_number);
                        $('#view_reg').text(res.data.Reg_number);
                        $('#view_checkout').text(res.data.Check_out);
                        $('#view_checkin').text(res.data.Check_in);
                        $('#view_gender').text(res.data.Gender);
                        $('#view_block').text(res.data.Block);
                        $('#view_room').text(res.data.Room_num);
                        $('#view_phone').text(res.data.Phone_num);
                        $('#view_parent').text(res.data.Parent_number);
                        $('#view_transport').text(res.data.Transport_detail);
                        $('#view_destination').text(res.data.Destination_add);
                        $('#view_reason').text(res.data.Reason);
                        $('#view_applydate').text(res.data.sapply_date);

                        $('#studentViewModal').modal('show');
                    }
                }
            });
        });

       
    </script>

</body>
</html>