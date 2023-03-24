<?php
    if(isset($_POST['submit'])) {    
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $negara = $_POST['negara'];
        $didirikan = $_POST['didirikan'];
        $status = $_POST['status'];

        $url='http://47.88.89.199/fairuz_personal/sait_tugas_api/toserba_api.php?id='.$id.'';
        $ch = curl_init($url);
        $jsonData = array(
            'nama' =>  $nama,
            'negara' =>  $negara,
            'didirikan' =>  $didirikan,
            'status' =>  $status
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
        echo "<br>Sukses mengupdate data di ubuntu server !";
        echo "<br><a href=SelectToserbaView.php> OK </a>";
    }
?>

 