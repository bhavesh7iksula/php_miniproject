<?php
//echo "string";exit;
include 'dbcon.php';
print_r($_GET);
 if(isset($_GET['id'])){
 		$id = $_GET['id'];
 		
                        $sql = "UPDATE Customer SET role = '1' WHERE id = $id";

                        if (mysqli_query($conn, $sql)) {
                            echo "You Are Now Admin";
                        } else {
                            echo "Error Adding admin : " . mysqli_error($conn);
                        }
                    

}



?>