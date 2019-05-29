
<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/db.php");
require("../includes/functions.php");

$connection = dbConnect();

if(isset($_POST['name'])){
    $name = $_POST['name'];
}else{
    echo "Ingen tillåten post (Name)";
    exit;
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}else{
    echo "Ingen tillåten post (Email)";
    exit;
}
if(isset($_POST['pwd'])){
    $pass = $_POST['pwd'];
}else{
    echo "Ingen tillåten post (Password)";
    exit;
}

$createUser = addKund($connection);

if(isset($createUser) && $createUser > 0 ) {
    $userData = getKund($connection, $createUser);
    echo json_encode($userData);
}


dbDisconnect($connection);
?>
