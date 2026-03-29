<?php
include 'db.php';

$phone=$_POST['phone'];

$sql="DELETE FROM passengers WHERE phone='$phone'";

if($conn->query($sql)==TRUE)
{
    echo "Record Deleted Successfully";
}
else
{
    echo "Error deleting record";
}

?>