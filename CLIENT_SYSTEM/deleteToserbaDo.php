<?php

    $nama = $_GET['nama'];
    $url='http://47.88.89.199/fairuz_personal/sait_tugas_api/toserba_api.php?nama='.$nama.'';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $resultData = curl_exec($ch);
    $result = json_decode($resultData, true);

    if ($resultData) {
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', 'password');
        define('DB_NAME', 'sait_db');

        $mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if($mysqli){
            $query="DELETE FROM toko WHERE nama = '" . $nama . "'";
            mysqli_query($mysqli, $query);
            curl_close($ch);

            header("Location: selectToserbaView.php");
            die();
        }
    } else {
        curl_close($ch);
        echo $resultData;
        echo "Something is wrong!";
    }

?>