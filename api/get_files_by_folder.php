
<?php
$user_id = $_POST['user_id'];
$folder_id = $_POST['folder_id'];
$db = mysqli_connect('localhost', 'root', '', 'db_fms');
$sql = "SELECT * FROM files where user_id = '$user_id' and folder_id ='$folder_id'";
$q = mysqli_query($db,$sql) or die (mysqli_error($db));

    $response_array['data'] = array();
  

    while($r = mysqli_fetch_assoc($q))
    {
        $folder_id =$r["folder_id"];
        $sql3 = "SELECT folder_name FROM folder where user_id = '$folder_id'";
        $q3 = mysqli_query($db,$sql3) or die (mysqli_error($db));
        $folder_name="";
                    while($r3 = mysqli_fetch_assoc($q3))
                    {
                        $folder_name=  $r3['folder_name'];
                    }
        $response["folder_name"] =  $folder_name;   
        
        if($folder_id=="0"){
            $response["file_path"] ="0";
        }else{
            $response["file_path"] = $folder_name;
        }


        $response["filename"] =$r['filename'];
	    array_push($response_array['data'], $response);
    }





    echo json_encode($response_array);

    
?>