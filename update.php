<!--TRUELOGIC ONLINE SOLUTIONS INC. -->
<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "error";
} 

$article_title = $_POST['article_title'];
$article_content = $_POST['article_content'];
$id = $_POST['id'];
$sql = "UPDATE articles SET article_title = '$article_title', article_content = '$article_content' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    header('Location: index.php');

} else {
    echo "Error updating record: " . $conn->error;
}



?>