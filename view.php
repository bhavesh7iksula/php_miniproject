<?php
include 'dbcon.php';
$res = '';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * from Customer where id=" . $id;
    $query = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($query);
    //print_r($res);

    $sql2 = "SELECT *  from customer_datails where CustomerID =" . $id;

    $query1 = mysqli_query($conn, $sql2);

    $secresult = mysqli_fetch_assoc($query1);
    //print_r($secresult);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customer details table</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style type="text/css">
            .header{
                text-align: center;
                font-size: 2em;
                background-color: #eee;
            }
            .col-sm-6 {
                padding: 40px;
            }
            .title{
                text-align: center;
                padding: 30px;
            }
            label{
                padding-right: 60px;

            }

        </style>
    </head>
    <body>

        <div class="container">
            <div class="page-header">
                <h1>Customer View Page</h1>
            </div>
            <div class="header">Basic Residential Information</div>
            <div class="row">
                <div class="col-sm-6">
                    <p><label>Customer Id :</label><?php echo $res['id']; ?></p><br>
                    <p><label>Name :</label> <?php echo $res['name']; ?></p><br>
                    <p><label>Email :</label><?php echo $res['email']; ?></p><br>
                    <p><label>Gender :</label><?php echo $res['gender']; ?></p><br>

                </div>

                <div class="col-sm-6">
                    <p><label>Cell Phone :</label><?php echo $res['phone_no']; ?></p><br>
                    <p><label>Customer Add Date:</label><?php echo $res['date']; ?></p><br>

                </div>
            </div>
            <div class="header">Address</div>
            <div class="row">
                <div class="col-sm-6">
                    <p class="title">Residential Address</p>
                    <p><label> Primary Address :</label><?php echo $res['address']; ?></p><br>
                    <p><label> Primary City :</label><?php echo $res['city']; ?></p><br>
                    <p><label> Primary State :</label><?php echo $res['state']; ?></p><br>
                </div>
                <div class="col-sm-6">
                    <p class="title">Secondary Address</p>
                    <p><label>Secondary Address :</label><?php echo $secresult['address']; ?></p><br>
                    <p><label>Secondary City :</label><?php echo $secresult['city']; ?></p><br>
                    <p><label>Secondary State :</label><?php echo $secresult['state']; ?></p><br>

                </div>
            </div>
        </div>
    </body>
</html>


