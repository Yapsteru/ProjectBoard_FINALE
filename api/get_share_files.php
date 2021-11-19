<?php
$user_id = $_POST['user_id'];

    $conn = mysqli_connect("localhost","root","") or die (mysqli_error($conn));
    $db = mysqli_select_db($conn,"db_fms");
    $sql = "SELECT *,a.user_id as owner FROM `files` a inner join share b on a.f_id = b.file_id where b.user_id = '$user_id'";
    $q = mysqli_query($conn,$sql) or die (mysqli_error($conn));

        $response["data"] = array();
        while ($data = mysqli_fetch_array($q)) {
            $owner_id = $data["owner"];
            $sql2 = "SELECT name FROM users where user_id = '$owner_id'";
            $q2 = mysqli_query($conn,$sql2) or die (mysqli_error($conn));
            $owned_by="";
						while($r = mysqli_fetch_assoc($q2))
						{
                            $owned_by=  $r['name'];
                        }
                        $folder_id =$data["folder_id"];
                        $sql3 = "SELECT folder_name FROM folder where user_id = '$folder_id'";
                        $q3 = mysqli_query($conn,$sql3) or die (mysqli_error($conn));
                        $folder_name="";
                                    while($r3 = mysqli_fetch_assoc($q3))
                                    {
                                        $folder_name=  $r3['folder_name'];
                                    }
            $list["folder_name"] =  $folder_name;                        
            $list["f_id"] = $data["f_id"];
            $list["folder_id"] = $data["folder_id"];
            $list["user_id"] = $data["user_id"];
            $list["date_uploaded"] = $data["date_uploaded"];
            $list["filename"] = $data["filename"]." owned by ".$owned_by;
            $list["file_type"] = $data["file_type"];
            $list["remarks"] = $data["remarks"];
            $list["file_type"] = $data["file_type"];
           if($folder_id=="0"){
            $list["file_path"] ="0";
           }else{
  $list["file_path"] = $folder_name;
           }
            array_push($response["data"], $list);
        }
    	echo json_encode($response);
?>