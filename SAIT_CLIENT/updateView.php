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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Student Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <style>
        html, body {
            margin: 0;
            height: 100%;
        }

        .scroll {
            overflow: scroll;
        }

        .input-group-text {
            border-radius: 5px 0px 0px 5px;
        }
    </style>
</head>
<body>

    <div class="card mx-auto my-4" style="width: 30vw;">
        <div class="card-header">
            <h5 class="card-title mb-1"><b>PSAIT UTS 20230414</b></h5>
            <p class="card-subtitle text-muted">UTS Tasks | Update Student Data</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-auto mb-2">
                    <h5 class="card-title mb-0">Update Student Data</h5>
                    <small class="card-text text-muted">Please Specify The New Student's Data!</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
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
                        <input type="submit" class="btn btn-info" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>