<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");

require("../includes/conn_mysql.php");
require("../includes/rabbit_functions.php");

// Skapar databaskopplingen
$connection = dbConnect();

if(isset($_POST['rabbitName'])){
    $name = $_POST['rabbitName'];
}else{
    echo "Ingen tillåten post (name)";
    exit;
}
if(isset($_POST['rabbitBreedId'])){
    $breed = $_POST['rabbitBreedId'];
}else{
    echo "Ingen tillåten post (breed)";
    exit;
}
if(isset($_POST['rabbitBreederId'])){
    $breeder = $_POST['rabbitBreederId'];
}else{
    echo "Ingen tillåten post (breeder)";
    exit;
}

$createRabbit = createRabbit($connection);

if(isset($createRabbit) && $createRabbit > 0 ) {
    $rabbit = getRabbit($connection, $createRabbit);

    $output = $rabbit;

    echo json_encode($output);
}

// Stänger databaskopplingen
dbDisconnect($connection);
?>
