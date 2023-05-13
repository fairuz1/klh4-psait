<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
        .scroll {
            overflow: scroll;
        }

        .input-group-text {
            border-radius: 5px 0px 0px 5px;
        }
    </style>
</head>
<body>
    <div class="card mx-auto my-4" style="width: 50vw;">
        <div class="card-header">
            <h5 class="card-title mb-1"><b>PSAIT 20230505</b></h5>
            <p class="card-subtitle text-muted">Data from Ubuntu Server</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-auto mb-2">
                    <h5 class="card-title mb-0">Convinience Store Arround The World!</h5>
                    <small class="card-text text-muted">Every Toserba data that exsist in the server and was taken with API.</small>
                </div>
                <div class="col-auto ml-auto">
                    <a href="insertToserbaView.php" class="btn btn-info pull-right"><i class="fa fa-plus mr-2"></i>Tambah Data</a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php
                        $curl= curl_init();
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_URL, 'http://47.88.89.199/fairuz_personal/sait_tugas_api/toserba_api.php');
                        $res = curl_exec($curl);
                        $json = json_decode($res, true);

                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead class='text-center'>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Name</th>";
                                            echo "<th>Negara</th>";
                                            echo "<th>Tanggal Didirikan</th>";
                                            echo "<th>Status</th>";
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    for ($i = 0; $i < count($json["data"]); $i++){
                                        echo "<tr>";
                                            echo "<td> {$json["data"][$i]["id"]} </td>";
                                            echo "<td> {$json["data"][$i]["nama"]} </td>";
                                            echo "<td> {$json["data"][$i]["negara"]} </td>";
                                            echo "<td> {$json["data"][$i]["didirikan"]} </td>";
                                            echo "<td> {$json["data"][$i]["status"]} </td>";
                                            echo "<td>";
                                                echo '<a href="updateToserbaView.php?nama='. $json["data"][$i]["nama"] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="deleteToserbaDo.php?nama='. $json["data"][$i]["nama"] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";

                        curl_close($curl);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card mx-auto my-4" style="width: 50vw;">
        <div class="card-header">
            <h5 class="card-title mb-1"><b>PSAIT 20230505</b></h5>
            <p class="card-subtitle text-muted">Data from Local Server</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-auto mb-2">
                    <h5 class="card-title mb-0">Convinience Store Arround The World!</h5>
                    <small class="card-text text-muted">Every Toserba data that exsist in the local server</small>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php

                        define('DB_SERVER', 'localhost');
                        define('DB_USERNAME', 'root');
                        define('DB_PASSWORD', 'password');
                        define('DB_NAME', 'sait_db');

                        $mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                        if($mysqli){
                            $query  = "SELECT * FROM toko";
                            $data   = array();
                            $result = $mysqli->query($query);

                            while ($row=mysqli_fetch_object($result)) {
                                $data[]=$row;
                            }
                        }

                        $data = json_decode(json_encode($data), true);

                        echo '<table class="table table-bordered table-striped">';
                            echo "<thead class='text-center'>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Name</th>";
                                    echo "<th>Negara</th>";
                                    echo "<th>Tanggal Didirikan</th>";
                                    echo "<th>Status</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            for ($i = 0; $i < count($data); $i++){
                                echo "<tr>";
                                    echo "<td> {$data[$i]["id"]} </td>";
                                    echo "<td> {$data[$i]["nama"]} </td>";
                                    echo "<td> {$data[$i]["negara"]} </td>";
                                    echo "<td> {$data[$i]["didirikan"]} </td>";
                                    echo "<td> {$data[$i]["status"]} </td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>