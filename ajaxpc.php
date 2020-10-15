<?php
header("Access-Control-Allow-Origin: *");
include "config.php";
include "database.php";

$function='';
if(isset($_POST['function'])){
    $function=$_POST['function'];
}

if($function=='get_log'){
    $query_log=mysqli_query($link,"SELECT * FROM `log` LIMIT 1");
    $data_log=mysqli_fetch_assoc($query_log);
    if($data_log!=null){
        if($data_log['type']=='voice'){
            $txt_search_act=$data_log['value'];
            $query_action=mysqli_query($link,"SELECT `type`, `id`,`value`, `mp3` FROM `action` WHERE MATCH (`txt`) AGAINST ('$txt_search_act' IN BOOLEAN MODE) LIMIT 1");
            $data_action=mysqli_fetch_assoc($query_action);
            $data_log['type']=$data_action['type'];
            $data_log['val']=$data_action['value'];
            $data_log['mp3']=$data_action['mp3'];
            $query_delete_log=mysqli_query($link,"DELETE FROM `log`");
        }
    }
    echo json_encode($data_log);
}
?>