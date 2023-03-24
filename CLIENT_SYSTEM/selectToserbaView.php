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
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <style>
        .scroll {
            overflow: scroll;
        }
    </style>
</head>
<body>
    <div class="card mx-auto my-4" style="width: 50vw;">
        <div class="card-header">
            <h5 class="card-title mb-1"><b>PSAIT 20230317</b></h5>
            <p class="card-subtitle text-muted">Creating and returning data from API server and displaying it on local machine</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-auto mb-2">
                    <h5 class="card-title mb-0">Data Toserba Seluruh Dunia</h5>
                    <small class="card-text text-muted">Every Toserba data that exsist in the server and was taken with API.</small>
                </div>
                <div class="col-auto ml-auto">
                    <a href="insertToserbaView.php" class="btn btn-info pull-right"><i class="fa fa-plus mr-2"></i>Tambah Data</a>
                </div>
            </div>

            <div class="row scroll">
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
                                                echo '<a href="updateToserbaView.php?id='. $json["data"][$i]["id"] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a href="deleteToserbaDo.php?id='. $json["data"][$i]["id"] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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