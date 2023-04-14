<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Scores!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 1000px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <style>
        div.scroll {
            width: 1000px;
            height: 600px;
            overflow: scroll;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Access all students data in here!</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus mr-2"></i>Add Score</a>
                    </div>
                </div>
            </div>

            <div class="scroll">
                <?php
                // Include config file
                require_once "config.php";
                
                // Attempt select query execution
                $sql = "
                    SELECT 
                    mahasiswa.nim AS nim, 
                    mahasiswa.nama AS nama, 
                    mahasiswa.alamat AS alamat,
                    mahasiswa.tanggal_lahir AS tanggal_lahir,
                    matakuliah.kode_mk AS kode_mk,
                    matakuliah.nama_mk AS nama_mk,
                    matakuliah.sks AS sks,
                    perkuliahan.nilai AS nilai

                    FROM mahasiswa
                    INNER JOIN perkuliahan ON perkuliahan.nim = mahasiswa.nim
                    INNER JOIN matakuliah ON matakuliah.kode_mk = perkuliahan.kode_mk;
                ";

                if ($result = mysqli_query($mysqli, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
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
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['nim'] . "</td>";
                                    echo "<td>" . $row['nama'] . "</td>";
                                    echo "<td>" . $row['alamat'] . "</td>";
                                    echo "<td>" . $row['tanggal_lahir'] . "</td>";
                                    echo "<td>" . $row['kode_mk'] . "</td>";
                                    echo "<td>" . $row['nama_mk'] . "</td>";
                                    echo "<td>" . $row['sks'] . "</td>";
                                    echo "<td>" . $row['nilai'] . "</td>";
                                    echo "<td>";
                                        echo '<a href="read.php?nim='. $row['nim'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                        echo '<a href="update.php?nim='. $row['nim'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                        echo '<a href="delete.php?nim='. $row['nim'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($mysqli);
                ?>
            </div>     
        </div>
    </div>
</body>
</html>