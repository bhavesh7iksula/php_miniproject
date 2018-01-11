<?php
include 'dbcon.php';
print_r($_GET);
  if(isset($_GET['id'])){
                        $id = $_GET['id'];
                        
                       
                        
                        $sql = "DELETE FROM Customer WHERE id=".$id;

                        if (mysqli_query($conn, $sql)) {
                            //echo "Record deleted successfully";
                            header('location:cust_view.php');
                        } else {
                            echo "Error deleting record: " . mysqli_error($conn);
                        }
                    
}

?>






