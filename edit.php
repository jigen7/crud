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

$sql = "SELECT * FROM articles where id = ". $id;
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple NEWS CRUD</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">EDIT</a>
        </div>
        <div class="text-right">
            <div class="top-btn-container btn-group">
                <button class="btn btn-default" onclick="location.href='add.php'">Add New</button>
                <button class="btn btn-default"  onclick="location.href='import.php'">Import CSV</button>
            </div>
        </div>
      </div>
    </nav>
    <div id="main-container" class="container">
        
      <table id="test" class="table table-hovered display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center" style="width:15px"><input type="checkbox" class="check_all" /></th>
                <th>Title</th>
                <th>Summary</th>
                <th class="text-center" style="width:20%">Date Added</th>
                <th class="text-center" style="width:120px">Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="text-center"><input type="checkbox" class="check_all" /></th>
                <th>Title</th>
                <th>Summary</th>
                <th class="text-center">Date Added</th>
                <th class="text-center">Actions</th>
            </tr>
        </tfoot>
        <tbody>
            <form action="update.php" method="POST">

        <?php 
            if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td class="text-center"><input type="checkbox" class="check_row" /></td>
                <td><input name="article_title" type="text" value="<?php echo $row['article_title'];?>" ></td>
                <td><input name="article_content" type="text" value="<?php echo $row['article_content'];?>"></td>
                <td><input type = "submit"><input name="id" type="hidden" value="<?php echo $row['id'];?>"></td>
            </tr>
        <?php 
            }
        }
        ?>

            </form>
        </tbody>
    </table>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" class="init">
    $(document).ready(function() {
        $('#test').DataTable();
    });
    </script>
  </body>
</html>
<!--TRUELOGIC ONLINE SOLUTIONS INC. -->
