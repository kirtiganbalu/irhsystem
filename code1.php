<?php

require 'config.php';



if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);

    $query = "SELECT * FROM signup_student WHERE Student_ID='$student_id'";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Student Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Student Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

?>