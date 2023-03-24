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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Data Toserba Baru!</h2>
                    </div>
                    <p>Tau Toko Serba ada di Belahan Dunia? Ayo Isi Data Toko Tersebut! Sebarkan ke Orang Lain Keberadaanya!</p>
                    <form action="insertToserbaDo.php" method="post">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Negara</label>
                            <input type="text" name="negara" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Didirikan</label>
                            <input type="text" name="didirikan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>