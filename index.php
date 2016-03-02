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

$sql = "SELECT * FROM articles where is_deleted = 0";
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
          <a class="navbar-brand" href="index.php">Main Menu</a>
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

        <?php 
            if ($result->num_rows > 0) {
                 while($row = $result->fetch_assoc()) {
              $id = $row['id'];
              ?>
            <tr>
                <td class="text-center"><input type="checkbox" class="check_row" /></td>
                <td><?php echo $row['article_title'];?></td>
                <td><?php echo $row['article_content'];?></td>
                <td class="text-center"><?php echo $row['date_created'];?></td>
                <td class="text-center">
                    <div class="btn-group">
                        <button class="btn btn-default btn-xs" onclick="location.href='view.php?view_id=<?php echo $id;?>'">view</button>
                        <button class="btn btn-default btn-xs" onclick="location.href='edit.php?view_id=<?php echo $id;?>'">edit</button>
                        <button class="btn btn-default btn-xs" onclick="location.href='delete.php?view_id=<?php echo $id;?>'">delete</button>
                    </div>
                </td>
            </tr>
        <?php 
            }
        }
        ?>
            
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
