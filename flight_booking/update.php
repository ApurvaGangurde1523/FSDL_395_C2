<?php
include 'db.php';

$phone=$_POST['phone'];
$email=$_POST['email'];

$sql="UPDATE passengers SET email='$email' WHERE phone='$phone'";

if($conn->query($sql)==TRUE)
{
    echo "Record Updated Successfully";
}
else
{
    echo "Error updating record";
}

?>