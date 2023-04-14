<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <?php
        $nim       = $_GET['nim'];
        $kode_mk   = $_GET['kode_mk'];
        
        $url       = 'http://47.88.89.199/fairuz_personal/sait_uts_api/API.php?nim=' . $nim . '&kode_mk='. $kode_mk .'';
        $curl      = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res   = curl_exec($curl);
        $json  = json_decode($res, true);

        $json_data = $json['data'];
        for ($i=0; $i < count($json_data); $i++) { 
            if ($json_data[$i]['kode_mk'] == $kode_mk) {
                $data_nim = $json_data[$i]['nim'];
                $data_kode_mk = $json_data[$i]['kode_mk'];
                $data_nilai = $json_data[$i]['nilai'];
                break;
            }
        }
    ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Student Data</h2>
                    </div>
                    <p>Please Specify The New Student's data!</p>
                    
                    <form action="update.php" method="post">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control" value="<?php echo $data_nim; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Course Code</label>
                            <input type="text" name="kode_mk" class="form-control" value="<?php echo $data_kode_mk; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Score</label>
                            <input type="number" name="nilai" class="form-control" value="<?php echo $data_nilai; ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>