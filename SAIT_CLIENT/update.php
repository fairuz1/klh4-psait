<?php
    if(isset($_POST['submit'])) {    
        $nim        = $_POST['nim'];
        $kode_mk    = $_POST['kode_mk'];
        $nilai      = $_POST['nilai'];

        $url    ="http://47.88.89.199/fairuz_personal/sait_uts_api/API.php?nim='$nim'&kode_mk='$kode_mk'";
        $ch     = curl_init($url);
        $jsonData = array(
            'nim'       =>  $nim,
            'kode_mk'   =>  $kode_mk,
            'nilai'     =>  $nilai
        );

        $jsonDataEncoded = json_encode($jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

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
    }
?>

 