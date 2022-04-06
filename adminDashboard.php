<!DOCTYPE html>
<html lang="en">
<head>
  <title>MOODLE Test</title>

  <?php
    session_start();
    if(isset($_SESSION["userIDTesting"])){
  
      $name = $_SESSION["name"];
      
  
    }else{
      header("Location: index.php"); 
    }

    require_once("inc/SqlDatabase.php");
    $db = new UiDB();
	$data = $db->getallrecords();

    require_once('links.php');
  ?>
  
</head>
<body>

  <?php
      require_once('header.php');
  ?>

    <table id='marksTable' class='display dataTable table-design'>

        <thead>
        <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Marks</th>
            <th>Date</th>
        </tr>
        
        </thead>

        <?php if(!empty($data)) { $sno = 1; ?>
            <?php foreach($data as $user) { ?>
                <tr>
                    <td><?php echo $sno;?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['marks_obtained']; ?></td>
                    <td><?php echo $user['created_date']; ?></td>
                </tr>

            <?php $sno++; }  ?>
        <?php } ?>

    </table>

  <?php
      require_once('footer.php');
  ?>
</body>
</html>
<script>
jQuery(document).ready(function($) {
    $('#marksTable').DataTable();
} );
</script>