<?php
////$ab = array('a' => 's');
//echo '3333333333333333333333333';
////exit;
session_start();
include 'dbcon.php';
//print_r($_SESSION['login_user']);
if (!empty($_SESSION['login_user'])) {
    $user = $_SESSION['login_user'];
    $sql = "SELECT * FROM user11 WHERE username ='$user'";
    $result = mysqli_query($conn, $sql);
    $array = mysqli_fetch_array($result);
    if ($array['role'] == 1) {
        if (isset($_POST['keywords']) && is_numeric($_POST['keywords'])) {            
            $phone = $_POST['keywords'];
            $sql = "Select * from Customer where phone_no = '" . $phone . "'";
        }
    }
}
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    //$result = mysqli_query($conn, $sql);
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
                                    <td><button class = 'edit'><a href='cust_form.php?id='" . $row['id'] . "'>EDIT</a></button></td>
                                    <td><button class = 'view'><a href=''>VIEW</a></button></td>
                                    <td><button class = 'delete'><a href='delete.php?id='" . $row['id'] . "'>DELETE</a></button></td>
                      <td><button class = 'role'><a href='assign_role.php?id='" . $row['id'] . "'>ADMIN ROLE</a></button></td><tr>";
    }
}
if (isset($_POST['keywords'])) {
    echo $res;
}
?>