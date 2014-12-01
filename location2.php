<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Christmas Tree Sales Tool Report</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
$db = pg_connect('host=ec2-54-228-232-120.eu-west-1.compute.amazonaws.com dbname=d10majr7bnqjkd user=gptpgsxlzwywhc password=QRtlOrbHappBxRDg0kR1FW76TC');
?>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Tacoli Sales Report</a>
            </div>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="">
                        <a href="location1.php"><i class="fa fa-fw fa-location-arrow"></i> LUDOVICO</a>
                    </li>
                    <li class="active">
                        <a href="location2.php"><i class="fa fa-fw fa-location-arrow"></i> CLEMENS</a>
                    </li>
                    <li class="">
                        <a href="location3.php"><i class="fa fa-fw fa-location-arrow"></i> VINCENZ</a>
                    </li>
                    <!--<li>
                        <a href="location2.php"><i class="fa fa-fw fa-location-arrow"></i> STAENDE</a>
                    </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> CLEMENS
                            </li>
                        </ol>
                    </div>
                </div>

 
                    <div class="col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php 
                                        $tval = "SELECT TO_CHAR(SUM(CAST(tree_solds.sub_total AS NUMERIC)),'999,999.99') AS rtotal FROM tree_solds
                                                 left join trees on tree_solds.tree_id = trees.id
                                                 left join transactions on transactions.id = tree_solds.transaction_id
                                                 WHERE user_id = 12";
                                        $tvalue = pg_query($tval);
                                        $trev = pg_fetch_assoc($tvalue);
                                        echo $trev['rtotal'];
                                        ?>
                                        </div>
                                        <div>Total Profit!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tree fa-5x"></i>
                                    </div>

                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php 

                                        $sql = "SELECT trees.tree_type,tree_solds.transaction_id,tree_solds.actual_height,tree_solds.selling_height,tree_solds.sub_total,transactions.date_purchased FROM tree_solds
                                                        left join trees on tree_solds.tree_id = trees.id
                                                        left join transactions on transactions.id = tree_solds.transaction_id
                                                        WHERE user_id = 12";

                                        $res = pg_query($sql);

                                        $count = pg_num_rows($res);

                                        echo $count;
                                        ?>
                                        </div>
                                        <div>Total Tree Sold!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php 
                                        $tval = "SELECT TO_CHAR(SUM(CAST(tree_solds.sub_total AS NUMERIC)),'999,999.99') AS rtotal FROM tree_solds
                                                 left join trees on tree_solds.tree_id = trees.id
                                                 left join transactions on transactions.id = tree_solds.transaction_id
                                                 WHERE user_id = 12 AND DATE(transactions.date_purchased) = now()::date";
                                        $tvalue = pg_query($tval);
                                        $trev = pg_fetch_assoc($tvalue);
                                        echo $trev['rtotal'];
                                        ?>
                                        </div>
                                        <div>Total Profit TODAY!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-blue">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tree fa-5x"></i>
                                    </div>

                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        <?php 

                                        $sql = "SELECT trees.tree_type,tree_solds.transaction_id,tree_solds.actual_height,tree_solds.selling_height,tree_solds.sub_total,transactions.date_purchased FROM tree_solds
                                                        left join trees on tree_solds.tree_id = trees.id
                                                        left join transactions on transactions.id = tree_solds.transaction_id
                                                        WHERE user_id = 12 AND DATE(transactions.date_purchased) = now()::date";

                                        $res = pg_query($sql);

                                        $count = pg_num_rows($res);

                                        echo $count;
                                        ?>
                                        </div>
                                        <div>Tree Sold TODAY!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> All Transactions</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Transaction ID#</th>
                                                <th>Date</th>
                                                <th>Tree Type</th>
                                                <th>Actual Size</th>
                                                <th>Selling Size</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $query = ('SELECT trees.tree_type,tree_solds.transaction_id,tree_solds.actual_height,tree_solds.selling_height,tree_solds.sub_total,transactions.date_purchased FROM tree_solds
                                            			left join trees on tree_solds.tree_id = trees.id
                                            			left join transactions on transactions.id = tree_solds.transaction_id
                                            			WHERE user_id = 12 ORDER BY transactions.date_purchased DESC');


                                            $result = pg_query($query); 
                                            if (!$result) { 
                                                echo "Problem with query " . $query . "<br/>"; 
                                                echo pg_last_error(); 
                                                exit(); 
                                            } 

                                            while($myrow = pg_fetch_assoc($result)) { 
                                                printf ("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $myrow['transaction_id'], htmlspecialchars($myrow['date_purchased']), htmlspecialchars($myrow['tree_type']), htmlspecialchars($myrow['actual_height']), htmlspecialchars($myrow['selling_height']), htmlspecialchars($myrow['sub_total']));
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
