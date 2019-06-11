<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/conn_mysql.php");
require("../includes/rabbit_functions.php");

// Skapar databaskopplingen
$connection = dbConnect();

if(isset($_GET['rabbitId']) && $_GET['rabbitId'] > 0 ){
    $rabbitInfo = getRabbit($connection,$_GET['rabbitId']);
}else{
    echo "Inget giltligt ID";
}

$output = $rabbitInfo;

echo json_encode($output);

// Stänger databaskopplingen
dbDisconnect($connection);
?>
