<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Video Game Listings</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<h1>Video Games</h1>

<a href="game.php" title="Add a Game">Add a New Game</a>

<?php

// connect
$conn = new PDO('mysql:host=127.0.0.1;dbname=gcrfreeman', 'root', '');
$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// write the query to fetch the game data
$sql = "SELECT * FROM games ORDER BY name";

// run the query and store the results into memory
$cmd = $conn->prepare($sql);
$cmd -> execute();
$games = $cmd->fetchAll();

// start the table and add the headings
echo '<table class="table table-striped"><thead><th>Name</th><th>Age Limit</th>
    <th>Release Date</th><th>Size</th><th>Edit</th><th>Delete</th></thead><tbody>';

/* loop through the data, creating a new table row for each game
and putting each value in a new column */
foreach($games as $game) {
    echo '<tr><td>' . $game['name'] . '</td>
        <td>' . $game['age_limit'] . '</td>
        <td>' . $game['release_date'] . '</td>
        <td>' . $game['size'] . '</td>
        <td><a href="game.php?game_id=' . $game['game_id'] . '">Edit</a></td>
        <td>
        <a href="delete-game.php?game_id=' . $game['game_id'] .
            '" onclick="return confirm(\'Are you sure?\');">
            Delete</a></td></tr>';
}

// close the table
echo '</tbody></table>';

// disconnect
$conn = null;
?>
</body>
</html>