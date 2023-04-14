<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
    <div class="card mx-auto my-4" style="width: 30vw;">
        <div class="card-header">
            <h5 class="card-title mb-1"><b>PSAIT UTS 20230414</b></h5>
            <p class="card-subtitle text-muted">UTS Tasks | Adding new student score</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-auto mb-2">
                    <h5 class="card-title mb-0">Please specify the student's data!</h5>
                    <small class="card-text text-muted">Enter student data below</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form action="insert.php" method="post">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" name="nim" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Course Code</label>
                            <input type="text" name="kode_mk" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Score</label>
                            <input type="number" name="nilai" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-info" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>