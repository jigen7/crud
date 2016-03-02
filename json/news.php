<?php



//$action = $_GET['action'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

$action = $request[0];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "error";
} 


if ($action == "list"){
	$sql = "SELECT * FROM articles where is_deleted = 0";
	$result = $conn->query($sql);
	$jsonData = array();

	while ($row = $result->fetch_assoc()) {
    $jsonData[] = $row;
	}	

	$data['success']= TRUE;
	$data['error']= null;
	$data['data']= $jsonData;


} //end list
elseif ($action == "get") {
	$getid = $request[1];
	$sql = "SELECT * FROM articles where id = $getid";
	$result = $conn->query($sql);
	$jsonData = array();

	while ($row = $result->fetch_assoc()) {
    $jsonData[] = $row;
	}	

	$data['success']= TRUE;
	$data['error']= null;
	$data['data']= $jsonData;



} //end get
elseif ($action == "delete") {
		$getid = $request[1];

		$sql = "UPDATE articles SET is_deleted=1 WHERE id=".$getid;
		$data['success']= TRUE;
		$data['error']= null;
		$data['data'] = null;

} //end delete
elseif ($action == "insert") {

	if ($_SERVER['REQUEST_METHOD'] == "POST") { 

		$article_title = $_POST['article_title'];
		$article_content = $_POST['article_content'];
		$date = date("Y-m-d");

		$sql = "SELECT * FROM articles where article_title = '$article_title'";
		$result = mysqli_query($conn, $sql);


		if (mysqli_num_rows($result) > 0) {
			$data['success']= FALSE;
			$data['error']= "DUPLICATE ENTRY";
			$data['data'] = null;
			
		}
		else {
		
			$sql = "INSERT INTO articles (article_title, article_content, date_created) VALUES ('$article_title', '$article_content', '$date')";

			if ($conn->query($sql) === TRUE) {
			$data['success']= TRUE;
			$data['error']= null;
			$data['data'] = null;

			} else {
			$data['success']= FALSE;
			$data['error']= "ERROR INSERTING DATA";
			$data['data'] = null;
			}

		}
	} else{
			$data['success']= FALSE;
			$data['error']= "POST METHOD EXPECTED";
			$data['data'] = null;
	}	
} //end insert

elseif ($action == "update") {

	if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "PUT") { 	
		$article_title = $_POST['article_title'];
		$article_content = $_POST['article_content'];
		$id = $_POST['id'];
		$sql = "UPDATE articles SET article_title = '$article_title', article_content = '$article_content' WHERE id = $id";

		if ($conn->query($sql) === TRUE) {
			$data['success']= TRUE;
			$data['error']= null;
			$data['data'] = null;

		} else {
			$data['success']= FALSE;
			$data['error']= "ERROR UPDATING DATA";
			$data['data'] = null;	
		}
	} else{
			$data['success']= FALSE;
			$data['error']= "POST METHOD EXPECTED";
			$data['data'] = null;
	}	

} //end update



header('Content-Type: application/json');
echo json_encode($data);

?>