<?php

    $nim        = $_GET['nim'];
    $kode_mk    = $_GET['kode_mk'];

    $url        ="http://47.88.89.199/fairuz_personal/sait_uts_api/API.php?nim='$nim'&kode_mk='$kode_mk'";
    echo $url;

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

    if ($result["status"] == 1) {
        echo "<br>Successfuly Consume API!";
        echo "<br><a href=index.php> OK </a>";
    } else {
        echo "<br>Unsuccessful Attempt to Consume API!";
        echo "<br><a href=index.php> OK </a>";
    }

?>