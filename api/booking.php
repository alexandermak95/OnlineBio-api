<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/db.php");
require("../includes/functions.php");

$connection = dbConnect();

if(isset($_POST['userid'])){
    $name = $_POST['userid'];
}else{
    echo "Ingen tillåten post (userid)";
    exit;
}
if(isset($_POST['choice'])){
    $choice = $_POST['choice'];
}else{
    echo "Ingen tillåten post (choice)";
    exit;
}
if(isset($_POST['antal'])){
    $qtn = $_POST['antal'];
}else{
    echo "Ingen tillåten post (antal)";
    exit;
}

$ticket = ticket($connection);

if(isset($ticket)) {
  $myTickets = getSpec($connection, $ticket);
  echo  json_encode($myTickets);
}


dbDisconnect($connection);
?>
