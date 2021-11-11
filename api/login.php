<?php
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
// connect to database
$db = mysqli_connect('localhost', 'root', '', 'db_fms');


    $pass = md5($password);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
    $results = mysqli_query($db, $query);
    
    $response_array['data'] = array();
    $my_counter = mysqli_num_rows($results);
    $details = mysqli_fetch_assoc($results);
    if ($my_counter == 1) { // user found
        $response["user_id"] =$details['user_id'];
        $response["status"] =1;
	array_push($response_array['data'], $response);
    }else {
        $response["status"] =0;
	array_push($response_array['data'], $response);
    }
    echo json_encode($response_array);

    
?>