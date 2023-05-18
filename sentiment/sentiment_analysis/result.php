<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sentiment Analysis</title>

  <!-- Bootstrap core CSS -->
  <link href="style/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="style/css/shop-item.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Sentiment Analysis</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Input Sentence</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container" height="1000px">

    <div class="row">

      <div class="col-lg-3">
        <p>
        <div class="list-group">
          <a href="index.php" class="list-group-item active">Home</a>
          <a href="index.php" class="list-group-item">Input Sentence</a>
          <a href="about.php" class="list-group-item">About Us</a>
        </div>
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">


        <!-- /.card -->

        <div class="card card-outline-secondary my-4" >
          <div class="card-header">
            Result Prediction
          </div>
          <div class="card-body" >


<!-- Start codes here -->

                 <center>

<?php
$sentence= $_POST['sentence'];
#echo($sentence);
$url='http://127.0.0.1:5000/sentence/prediction/';
$ch = curl_init($url);

$post = [
    'sentence' => $sentence,

];

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//pastikan mengirim dengan method POST
curl_setopt($ch, CURLOPT_POST, true);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);



//Execute the request
$result = curl_exec($ch);
$json = json_decode($result, true);
curl_close($ch);

#var_dump($result);
 

?>

     
                  <table class="table table-bordered">
          <tr>
                        <td>Sentence</td>
                        <td>
                        <?php echo($sentence); ?>
                        </td>
                     </tr>
           
                     <tr>
                        <td>Output prediction</td>
                        <td><?php echo($json['prediction']); ?></td>
                     </tr>

                  </table>
<p><p>
<!-- end codes here -->


            
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col-lg-9 -->

    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Interoperability Course 2022</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->

  <script src="style/vendor/jquery/jquery.min.js"></script>
  <script src="style/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
