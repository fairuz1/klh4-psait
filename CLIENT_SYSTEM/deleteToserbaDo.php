<?php

    $id = $_GET['id'];
    $url='http://47.88.89.199/fairuz_personal/sait_tugas_api/toserba_api.php?id='.$id.'';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $result = json_decode($result, true);

    curl_close($ch);

    print("<center><br>status :  {$result["status"]} "); 
    print("<br>");
    print("message :  {$result["message"]} "); 
    echo "<br>Sukses menghapus data di ubuntu server !";
    echo "<br><a href=selectToserbaView.php> OK </a>";

?>