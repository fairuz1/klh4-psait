<?php

    require_once "config.php";
    $request_method = $_SERVER["REQUEST_METHOD"];

    switch ($request_method) {
        case 'GET':
            if (!empty($_GET["nim"])) {
                $nim        = $_GET["nim"];
                getStudentData($nim);
            } else {
                getAllStudents();
            }

            break;

        case 'POST':
            if (!empty($_GET["nim"])) {
                $nim        = $_GET["nim"];
                $kode_mk    = $_GET["kode_mk"];
                updateStudentScore($nim, $kode_mk);
            } else {
                insertStudentScore();
            }

            break;

        case 'DELETE':
            $nim        = $_GET["nim"];
            $kode_mk    = $_GET["kode_mk"];
            deleteStudentScore($nim, $kode_mk);
            
            break;
        
        default:
            // Invalid Request Method
            header("HTTP/1.0 405 Method Not Allowed");
            break;
    }

    function getAllStudents() {
        global $mysqli;
        $query  = "
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
        $data   = array();
        $result = $mysqli->query($query);

        if ($result) {
            while ($row = mysqli_fetch_object($result)) {
                $data[] = $row;
            }

            $response=array(
                'status'    => 1,
                'message'   => 'Successfully Returned All Student Data',
                'data'      => $data
            );

        } else {
            $response   = array(
                'status'    => 0,
                'message'   => 'Something is Wrong When Fetching Students Data',
            );
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function getStudentData($nim) {
        global $mysqli;
        $query  = "
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
            INNER JOIN matakuliah ON matakuliah.kode_mk = perkuliahan.kode_mk
            WHERE mahasiswa.nim = '$nim';
        ";

        $data   = array();
        $result = $mysqli->query($query);

        if ($result) {
            while ($row=mysqli_fetch_object($result)) {
                $data[]=$row;
            }

            $response   = array(
                'status'    => 1,
                'message'   => 'Successfully Returned Student Data with NIM = ' . $nim,
                'data'      => $data
            );
        } else {
            $response   = array(
                'status'    => 0,
                'message'   => 'Something is Wrong When Student Data with NIM = ' . $nim,
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function insertStudentScore() {
        global $mysqli;
        
        if (!empty($_POST["nim"])) {
            $data   = $_POST;
        } else {
            $data   = json_decode(file_get_contents('php://input'), true);
        }

        $arrcheckpost   = array('nim' => '', 'kode_mk' => '', 'nilai' => '');
        $hitung         = count(array_intersect_key($data, $arrcheckpost));

        if ($hitung == count($arrcheckpost)) {
            $query  = "
                INSERT INTO perkuliahan (nim, kode_mk, nilai)
                VALUES (
                    (SELECT nim FROM mahasiswa WHERE nim = '$data[nim]'), 
                    (SELECT kode_mk FROM matakuliah WHERE kode_mk = '$data[kode_mk]'), 
                    '$data[nilai]'
                );
            ";

            $result = mysqli_query($mysqli, $query);

            if ($result) {
                $response=array(
                    'status' => 1,
                    'message' =>'Successfully Added New Student Score!'
                );
            } else {
                $response=array(
                    'status' => 0,
                    'message' =>'Failed Adding New Student Score!'
                );
            }

        } else {
            $response=array(
                'status' => 0,
                'message' =>'Parameters Does Not Match!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function updateStudentScore($nim, $kode_mk) {
        global $mysqli;

        if (!empty($_POST["nim"]) || !empty($_POST["kode_mk"])) {
            $data   = $_POST;
        } else {
            $data   = json_decode(file_get_contents('php://input'), true);
        }

        $arrcheckpost   = array('nim' => '', 'kode_mk' => '', 'nilai' => '');
        $hitung         = count(array_intersect_key($data, $arrcheckpost));
        
        if ($hitung == count($arrcheckpost)) {
            $query  = "
                UPDATE perkuliahan
                SET nilai = '$data[nilai]'
                WHERE nim = '$data[nim]' AND kode_mk = '$data[kode_mk]';
            ";
            
            $result = mysqli_query($mysqli, $query);
            
            if ($result) {
                $response=array(
                    'status'    => 1,
                    'message'   => 'Successfully Updated Student Score!'
                );

            } else {
                $response=array(
                    'status'    => 0,
                    'message'   => 'Failed Updating Student Score!'
                );
            }

        } else {
            $response=array(
                'status'    => 0,
                'message'   => 'Parameters Does Not Match!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function deleteStudentScore($nim, $kode_mk) {
        global $mysqli;
        $query="DELETE FROM perkuliahan WHERE nim = " . $nim . " AND kode_mk = " . $kode_mk;

	if (mysqli_query($mysqli, $query)) {
            $response=array(
                'status'    => 1,
                'message'   =>'Student Score Has Been Successfuly Deleted!'
            );

        } else {
            $response=array(
                'status'    => 0,
                'message'   =>'Failed in Deleting Student Score!'
            );
        }


        header('Content-Type: application/json');
        echo json_encode($response);
    }

?>