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
    <div class="card mx-auto my-4" style="width: 80vw;">
        <div class="card-header">
            <h5 class="card-title mb-1"><b>PSAIT UTS 20230414</b></h5>
            <p class="card-subtitle text-muted">UTS Tasks</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-auto mb-2">
                    <h5 class="card-title mb-0">University Students Data</h5>
                    <small class="card-text text-muted">Access all students data in here!</small>
                </div>
                <div class="col-auto ml-auto">
                    <a href="insertView.php" class="btn btn-info pull-right"><i class="fa fa-plus mr-2"></i>Add New Student Score</a>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php
                        $curl= curl_init();
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_URL, 'http://47.88.89.199/fairuz_personal/sait_uts_api/API.php');
                        $res = curl_exec($curl);
                        $json = json_decode($res, true);
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead class='text-center'>";
                                        echo "<tr>";
                                            echo "<th>NIM</th>";
                                            echo "<th>Name</th>";
                                            echo "<th>Address</th>";
                                            echo "<th>Brith Date</th>";
                                            echo "<th>Course Code</th>";
                                            echo "<th>Course Name</th>";
                                            echo "<th>SKS</th>";
                                            echo "<th>Score</th>";
                                            echo "<th>#</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody class='text-center'>";
                                    for ($i = 0; $i < count($json["data"]); $i++){
                                        echo "<tr>";
                                            echo "<td>" . $json["data"][$i]['nim'] . "</td>";
                                            echo "<td>" . $json["data"][$i]['nama'] . "</td>";
                                            echo "<td>" . $json["data"][$i]['alamat'] . "</td>";
                                            echo "<td>" . $json["data"][$i]['tanggal_lahir'] . "</td>";
                                            echo "<td>" . $json["data"][$i]['kode_mk'] . "</td>";
                                            echo "<td>" . $json["data"][$i]['nama_mk'] . "</td>";
                                            echo "<td>" . $json["data"][$i]['sks'] . "</td>";
                                            echo "<td>" . $json["data"][$i]['nilai'] . "</td>";
                                            echo "<td>";
                                                echo '<a href="updateView.php?nim='. $json["data"][$i]["nim"] .'&kode_mk='. $json["data"][$i]["kode_mk"] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="delete.php?nim='. $json["data"][$i]["nim"] .'&kode_mk='. $json["data"][$i]["kode_mk"] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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

</body>
</html>