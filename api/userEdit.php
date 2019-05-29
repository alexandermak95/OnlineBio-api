
<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/db.php");
require("../includes/functions.php");

$connection = dbConnect();

if(isset($_POST['editid'])){
    $id = $_POST['editid'];
}else{
    echo "Inget giltligt ID";
    exit;
}

if(isset($_POST['newName'])){
    $name = $_POST['newName'];
}else{
    echo "Inget giltligt namn";
    exit;
}

if(isset($_POST['newEmail'])){
    $email = $_POST['newEmail'];
}else{
    echo "Inget giltligt email";
    exit;
}

$newData = updateKund($connection);
if(isset($newData)) {
  echo json_encode($newData);
}

// Close DB
dbDisconnect($connection);
?>
