<!--TRUELOGIC ONLINE SOLUTIONS INC. -->
<?php

$id = $_GET['view_id'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "error";
} 

$sql = "UPDATE articles SET is_deleted=1 WHERE id=".$id;

$result = $conn->query($sql);
header('Location: index.php');

?>