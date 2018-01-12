<?php session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customer Details Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="js/jquery-3.2.1.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="jquery_ajax.js"></script>
        <style type="text/css">
            .title {
                display: inline-flex;
            }
            button.add {
                float: right;
                margin: 20px;
                border: none;
                border-radius: 5px;
                padding: 5px;
                color: white;
                background-color: black;

            }
            .add a{
                text-decoration : none;
                color: white;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <span class="title"><h2>Customer Details Table</h2></span>

            <?php
            include 'dbcon.php';
            $array = array();
            $user = '';
            if (!empty($_SESSION['user_id'])) {
                $userid = $_SESSION['user_id'];
                $sql = "SELECT * FROM Customer WHERE id ='$userid'";
                $result = mysqli_query($conn, $sql);
                $array = mysqli_fetch_array($result);
                if ($array['role'] == 1) {
                    if (isset($_POST['keywords']) && is_numeric($_POST['keywords'])) {
                        $phone = $_POST['keywords'];

                        $sql = "Select * from Customer where phone_no = '" . $phone . "'";
                    } else {
                        $sql = "SELECT * FROM Customer";
                    }
                    ?>
                    <button class="add"><a href ='cust_form.php'>Add New Customers</a></button>
                    <!-- start of search-->
                    <div class="searchDiv">
                        <label>Keywords : </label><input id ="keyword" type="text" name="phone"  placeholder ="Search db by phone no." autocomplete="off" />
                        <input type="submit" id="search" value="Search Db" >
                        <?php
                    }
                }
                ?>
            </div><!-- end of .searchDiv -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Phone No</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Date</th>
                        <th>Edit</th>
                        <th>View</th>
                        <th>Delete</th>
                        <?php if ($array['role'] == 1) { ?>
                            <th>Make admin</th>
                        </tr>
                    </thead>
                    <tbody class ='resultDiv'>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            $result = mysqli_query($conn, $sql);

                            $res = '';
                            while ($row = mysqli_fetch_array($result)) {

                                $res .= "<tr><td>" . $row['id'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['gender'] . "</td>
                                    <td>" . $row['phone_no'] . "</td>
                                    <td>" . $row['address'] . "</td>
                                    <td>" . $row['city'] . "</td>
                                    <td>" . $row['state'] . "</td>
                                    <td>" . $row['date'] . "</td>
                                    <td><button class = 'edit'><a href=cust_form.php?id=" . $row['id'] . ">EDIT</a></button></td>
                                    <td><button class = 'view'><a href=view.php?id=" . $row['id'] . ">VIEW</a></button></td>
                                    <td><button class = 'delete'><a href=delete.php?id=" . $row['id'] . ">DELETE</a></button></td>
                      <td><button class = 'role'><a href=assign_role.php?id=" . $row['id'] . ">ADMIN ROLE</a></button></td><tr>";
                            }
                            if (isset($_POST['keyword'])) {
                                echo $res;
                            }
                            echo $res;
                        } else {
                            echo "0 results for role==1";
                        }
                    } else {
                        $sql = "SELECT * FROM Customer WHERE id ='$userid'";

                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_array($result)) {


                                echo " <tr><td>" . $row['id'] . "</td>",
                                "<td>" . $row['name'] . "</td>",
                                "<td>" . $row['email'] . "</td>",
                                "<td>" . $row['gender'] . "</td>",
                                "<td>" . $row['phone_no'] . "</td>",
                                "<td>" . $row['address'] . "</td>",
                                "<td>" . $row['city'] . "</td>",
                                "<td>" . $row['state'] . "</td>",
                                "<td>" . $row['date'] . "</td>",
                                "<td><button class = 'edit'><a href='cust_form.php?id=" . $row['id'] . "'>EDIT</a></button></td>",
                                "<td><button class = 'view'><a href=''>VIEW</a></button></td>",
                                "<td><button class = 'delete'>Dont have permissions</button></td><tr>";
                            }
                        } else {
                            echo "0 results for different user";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>


