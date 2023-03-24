<?php
require_once "config.php";
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["id"])) {
            $id=intval($_GET["id"]);
            getData($id);
         } else {
            getDatas();
         }
         break;

   case 'POST':
         if(!empty($_GET["id"])) {
            $id=intval($_GET["id"]);
            updateData($id);
         }
         else {
            insertData();
         }     
         break; 

   case 'DELETE':
         $id=intval($_GET["id"]);
         deleteData($id);
         break;

   default:
         // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
         break;
}
   function getDatas() {
      global $mysqli;
      $query="SELECT * FROM toko";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result)) {
         $data[]=$row;
      }

      $response=array(
         'status' => 1,
         'message' =>'Successfully Returned Store Data.',
         'data' => $data
      );

      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   function getData($id=0) {
      global $mysqli;
      $query="SELECT * FROM toko";
      if($id != 0) {
         $query.=" WHERE id=".$id." LIMIT 1";
      }

      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result)) {
         $data[]=$row;
      }

      $response=array(
         'status' => 1,
         'message' =>'Successfully Returned Requested Data.',
         'data' => $data
      );

      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   function insertData() {
      global $mysqli;
      if(!empty($_POST["nama"])){
         $data=$_POST;
      } else {
         $data = json_decode(file_get_contents('php://input'), true);
      }

      $arrcheckpost = array('nama' => '','negara' => '','didirikan' => '','status' => '');
      $hitung = count(array_intersect_key($data, $arrcheckpost));
      if($hitung == count($arrcheckpost)) {
         $result = mysqli_query($mysqli, "INSERT INTO toko SET
         nama = '$data[nama]',
         negara = '$data[negara]',
         didirikan = '$data[didirikan]',
         status = '$data[status]'");                
         if($result) {
            $response=array(
               'status' => 1,
               'message' =>'Successfully Added Data!'
            );
         } else {
            $response=array(
               'status' => 0,
               'message' =>'Failed Adding Data!'
            );
         }
      } else {
         $response=array(
            'status' => 0,
            'message' =>'Parameters Do Not Match'
         );
      }

      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   function updateData($id) {
      global $mysqli;
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
         WHERE id=".$id);
         
         if($result) {
            $response=array(
               'status' => 1,
               'message' =>'Successfully Updated Data!'
            );
         } else {
            $response=array(
               'status' => 0,
               'message' =>'Failed Updating Data!'
            );
         }
      } else {
         $response=array(
            'status' => 0,
            'message' =>'Parameters Do Not Match'
         );
      }

      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   function deleteData($id) {
      global $mysqli;
      $query="DELETE FROM toko WHERE id=".$id;
      if(mysqli_query($mysqli, $query)) {
         $response=array(
            'status' => 1,
            'message' =>'The Data Has Been Successfully Deleted!'
         );
      } else {
         $response=array(
            'status' => 0,
            'message' =>'Failed in Deleting The Data!'
         );
      }

      header('Content-Type: application/json');
      echo json_encode($response);
   }
?> 
