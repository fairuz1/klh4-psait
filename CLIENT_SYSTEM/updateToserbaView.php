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
 $nama = $_GET['nama'];
 $curl= curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl, CURLOPT_URL, 'http://47.88.89.199/fairuz_personal/sait_tugas_api/toserba_api.php?nama='.$nama.'');
 $res = curl_exec($curl);
 $json = json_decode($res, true);
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Data</h2>
                    </div>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="updateToserbaDo.php" method="post">
                        <!-- <input type = "hidden" name="id" value="<?php echo"$id";?>"> -->
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo($json["data"][0]["nama"]); ?>">
                        </div>
                        <div class="form-group">
                            <label>Negara</label>
                            <input type="text" name="negara" class="form-control" value="<?php echo($json["data"][0]["negara"]); ?>">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Didirikan</label>
                            <input type="text" name="didirikan" class="form-control" value="<?php echo($json["data"][0]["didirikan"]); ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control" value="<?php echo($json["data"][0]["status"]); ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>