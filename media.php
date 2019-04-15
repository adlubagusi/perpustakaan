<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">

    <!-- Data Table -->
    <link href="media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
   
    
    
    
    
    
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
       <?php include "header.php"; ?>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <?php include "menu.php"; ?>
            </div>

            <div class="col-md-9">

                

                <div >
 
			<?php include "content.php"; ?>



                    

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <?php include "footer.php"; ?>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-1.12.4.js" type="text/javascript" language="javascript"></script>
    <script src="media/js/jquery.dataTables.js" type="text/javascript" language="javascript"></script>
    <script src="media/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="examples/resources/demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });    
    </script>
</body>

</html>
