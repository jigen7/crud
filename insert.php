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
$date = date("Y-m-d");


$sql = "SELECT * FROM articles where article_title = '$article_title'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
	echo "Error INSERTING record DUPLICATE TITLE";
}
else {
	
	$sql = "INSERT INTO articles (article_title, article_content, date_created) VALUES ('$article_title', '$article_content', '$date')";

	if ($conn->query($sql) === TRUE) {
    	echo "Record INSERTED successfully";
    	header('Location: index.php');

	} else {
    	echo "Error Inserting";
	}

}



?>