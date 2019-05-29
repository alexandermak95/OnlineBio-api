
<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/db.php");
require("../includes/functions.php");

$connection = dbConnect();

if(isset($_GET['id']) && $_GET['id'] > 0 ){
    $customerData = getKund($connection,$_GET['id']);
}else{
    echo "Inget giltligt ID";
}

echo json_encode($customerData);

// Close DB
dbDisconnect($connection);
?>
