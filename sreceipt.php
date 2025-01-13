<?php
session_start();
if(!isset($_SESSION['icnum'])){
    header('location:slogin.php');
}


?>


<html>
  <head>
    <title>Receipt</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/sreceipt.css">
  </head>
  <style>
        img{
      border-radius: 2%;
      border: 8px solid #DCDCDC;
      width: 230px;
      height: 225px;
    }
    </style>
  <body>

    <table class="body-wrap">
        <tbody><tr>
            <td></td>
            <td class="container" width="600">
                <input type="hidden" name=ID value="<?php echo $_SESSION['Student_ID'];  ?>">
                <input type="hidden" name=ID1 value="<?php echo $_POST['Approve']; ?>">
                
                <div class="content">
                    <table class="main" width="100%" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                            <td class="content-wrap aligncenter">
                            <?php
                            require 'config.php';
                            $query = "SELECT * FROM signup_student WHERE Student_ID='".$_SESSION['Student_ID']."'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {

                                
                           

                                    ?>
                                     <img src="img/<?php echo $student['camera']; ?>" id = "image">

<?php 
                                
                                
                            }
                        }
                            ?>
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tbody>
                                    <?php
                            require 'config.php';

                            $query = "SELECT * FROM sapplydb WHERE ID='".$_POST['Approve']."'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {
                                    $_SESSION['ID']=$student['ID'];

                                    ?>    
                                    <tr>
                                        
                                        <td class="content-block">
                                            <center><h2>Your appeal has been confirm</h2></center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <table class="invoice">
                                                <tr>
                                                    <td>
                                                        <table class="invoice-items" cellpadding="0" cellspacing="0">

                                                            <tbody>
                                                            <tr>
                                                                <td>Name :</td>
                                                                <td class="alignright">  <?= $student['Name'] ?>  </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Matric No :</td>
                                                                <td class="alignright">  <?=$student['Reg_number'] ?>  </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Room Number :</td>
                                                                <td class="alignright">  <?= $student['Block'] ?>    <?= $student['Room_num'] ?>  </td>
                                                            </tr>                                                                                                                                                                                        
                                                            <tr>
                                                                <td>Check Out Date :</td>
                                                                <td class="alignright">  <?= $student['Check_out'] ?>  </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Check In Date :</td>
                                                                <td class="alignright">  <?= $student['Check_in'] ?>  </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <?php
                                
                                
                            }
                        }
                        else{
                            header('location:sstatus.php');
                        }
                            ?>
                                            </tbody></table>
                                        </td>
                                    </tr>
                                    <?php
                            require 'config.php';
                            $query = "SELECT * FROM signup_warden WHERE Warden_ID='".$student['Warden_ID']."'";
                            $query_run = mysqli_query($conn, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $student)
                                {

                                
                           

                                    ?>
                                    <tr>
                                        <td class="content-block">
                                            Approve by Warden :     |  <?= $student['Name'] ?>  |
                                        </td>
                                    </tr>
                                    <?php 
                                
                                
                            }
                        }
                            ?>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
            </td>
            <td></td>
        </tr>
    </tbody></table>
  </body>
</html>
