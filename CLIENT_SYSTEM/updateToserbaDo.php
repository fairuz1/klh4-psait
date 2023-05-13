<?php
    if(isset($_POST['submit'])) {    
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $negara = $_POST['negara'];
        $didirikan = $_POST['didirikan'];
        $status = $_POST['status'];

        $url='http://47.88.89.199/fairuz_personal/sait_tugas_api/toserba_api.php?nama='.$nama.'';
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

        $resultData = curl_exec($ch);
        $result = json_decode($resultData, true);

        if ($resultData) {
            define('DB_SERVER', 'localhost');
            define('DB_USERNAME', 'root');
            define('DB_PASSWORD', 'password');
            define('DB_NAME', 'sait_db');
    
            $mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
            if($mysqli){

                if(!empty($_POST["nama"])){
                   $data=$_POST;
                } else {
                   $data = json_decode(file_get_contents('php://input'), true);
                }
          
                $arrcheckpost = array('nama' => '','negara' => '','didirikan' => '','status' => '');
                $hitung = count(array_intersect_key($data, $arrcheckpost));
                
                if($hitung == count($arrcheckpost)) {
                    $result = mysqli_query($mysqli, "UPDATE toko SET
                    nama = '$data[nama]',
                    negara = '$data[negara]',
                    didirikan = '$data[didirikan]',
                    status = '$data[status]' 
                    WHERE nama='" . $nama . "'");
                   
                    curl_close($ch);
                    header("Location: selectToserbaView.php");
                    die();
                } else {
                    echo "something is wrong!";
                }
            }
        } else {
            curl_close($ch);
            header("Location: selectToserbaView.php");
            die();
        }
    }
?>

 