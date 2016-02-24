<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
    <title>Video Game Details</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

<?php
// initialize variables
$game_id = null;
$name = null;
$age_limit = null;
$release_date = null;
$size = null;

//check if we have a numeric game ID in the querystring
if ((!empty($_GET['game_id'])) && (is_numeric($_GET['game_id']))) {

    //if we do, store in a variable
    $game_id = $_GET['game_id'];

    //connect
    $conn = new PDO('mysql:host=127.0.0.1;dbname=gcrfreeman',
        'root', '');

    //select all the data for the selected game
    $sql = "SELECT * FROM games WHERE game_id = :game_id";
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':game_id', $game_id, PDO::PARAM_INT);
    $cmd->execute();
    $games = $cmd->fetchAll();

    //store each value from the database into a variable
    foreach ($games as $game) {
        $name = $game['name'];
        $age_limit = $game['age_limit'];
        $release_date = $game['release_date'];
        $size = $game['size'];
    }

    //disconnect
    $conn = null;
}
?>

<h1>Game Details</h1>

<a href="games.php" title="Game Listings">View Games</a>

<form action="save-game.php" method="post">
    <fieldset>
        <label for="name" class="col-sm-2">Name:</label>
        <input name="name" id="name" placeholder="Enter Game Here" required
               value="<?php echo $name; ?>" />
    </fieldset>
    <fieldset>
        <label for="age_limit" class="col-sm-2">Age Limit:</label>
        <input name="age_limit" id="age_limit" placeholder="# Here"
               required type="number" min="0" max="200"
               value="<?php echo $age_limit; ?>" />
    </fieldset>
    <fieldset>
        <label for="release_date" class="col-sm-2">Release Date:</label>
        <input name="release_date" id="release_date" placeholder="Year Here"
               required type="number" min="1980" max="2016"
               value="<?php echo $release_date; ?>" />
    </fieldset>
    <fieldset>
        <label for="size" class="col-sm-2">Size:</label>
        <input name="size" id="size" placeholder="GB Here" required
               value="<?php echo $size; ?>" />
    </fieldset>
    <input name="game_id" id="game_id"
        type="hidden" value="<?php echo $game_id; ?>" />
    <button class="btn btn-primary col-sm-offset-2">Save</button>
</form>
</body>
</html>