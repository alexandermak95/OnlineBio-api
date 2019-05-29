
<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");

require("../includes/db.php");
require("../includes/functions.php");

$connection = dbConnect();

// Hämtar alla filmer
$allMovies = getMovies($connection);

echo json_encode($allMovies);

dbDisconnect($connection);
?>
