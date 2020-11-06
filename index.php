<?php // Do not put any HTML above this line
session_start();

require_once "pdo.php";

$stmt = $pdo->query("SELECT auto_id, make, model, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Oluwafemi Banji</title>
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2>Welcome to the Automobiles Database </h2>
    <?php
    if (isset($_SESSION['success'])) {
        echo('<p style="color: green;">' . htmlentities($_SESSION['success']) . "</p>\n");
        unset($_SESSION['success']);
    }
    ?>

    <ul>

        <?php
        if (isset($_SESSION['name'])) {
            if (sizeof($rows) > 0) {
                echo "<table border='1'>";
                echo " <thead><tr>";
                echo "<th>Make</th>";
                echo " <th>Model</th>";
                echo " <th>Year</th>";
                echo " <th>Mileage</th>";
                echo " <th>Action</th>";
                echo " </tr></thead>";
                foreach ($rows as $row) {
                    echo "<tr><td>";
                    echo($row['make']);
                    echo("</td><td>");
                    echo($row['model']);
                    echo("</td><td>");
                    echo($row['year']);
                    echo("</td><td>");
                    echo($row['mileage']);
                    echo("</td><td>");
                    echo('<a href="edit.php?auto_id='.$row['auto_id'].'">Edit</a> / <a href="delete.php?auto_id='.$row['auto_id'].'">Delete</a>');
                    echo("</td></tr>\n");
                }
                echo "</table>";
            } else {
                echo 'No rows found';
            }
            echo '</li><br/></ul>';
            echo '<p><a href="add.php">Add New Entry</a></p>
    <p><a href="logout.php">Logout</a></p><p>
        <b>Note:</b> Your implementation should retain data across multiple
        logout/login sessions.  This sample implementation clears all its
        data on logout - which you should not do in your implementation.
    </p>';
        } else {

            echo "<p><a href='login.php'>Please log in</a></p><p>Attempt to <a href='add.php'>add data</a> without logging in</p>";
        } ?>
</div>
</body>