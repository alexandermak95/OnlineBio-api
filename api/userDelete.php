<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/db.php");
require("../includes/functions.php");

$connection = dbConnect();

if(isset($_GET['deleteid']) && $_GET['deleteid'] > 0 ){
    $id = $_GET['deleteid'];
}else{
    echo "Inget giltligt ID";
    exit;
}
deleteKund($connection, $id);
echo 'User med id: ' . json_encode($id) . 'har Tagits bort';

// Close DB
dbDisconnect($connection);
?>
