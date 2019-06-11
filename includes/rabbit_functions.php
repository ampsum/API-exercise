<?php
/*
 * Visar alla kaniner (readall)
*/
function getAllRabbits($conn){
    $query = "SELECT rabbit.rabbitId, rabbit.rabbitName, breed.breedName, breed.breedId
    FROM breed
    INNER JOIN rabbit
    ON breed.breedId=rabbit.rabbitBreedId
    ORDER BY rabbit.rabbitId";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");
    $row = mysqli_fetch_all($result);
    return $row;
}

/*
 * Visar en kanin (read)
 */
function getRabbit($conn,$rabbitId){
    $query = "SELECT * FROM rabbit
			WHERE rabbitId=".$rabbitId;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");
    $row = mysqli_fetch_all($result);
    return $row;
}

/*
 * Skapar en ny kanin (create)
*/
function createRabbit($conn){
    $name = escapeInsert($conn,$_POST['rabbitName']);
    $breed = escapeInsert($conn,$_POST['rabbitBreedId']);
    $breeder = escapeInsert($conn,$_POST['rabbitBreederId']);

    $query = "INSERT INTO rabbit
			(rabbitName, rabbitBreedId, rabbitBreederId)
			VALUES('$name', '$breed','$breeder')";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $insId = mysqli_insert_id($conn);

    return $insId;
}

/*
 * Tar bort en kanin (delete)
*/
function deleteRabbit($conn,$rabbitId){
    $query = "DELETE FROM rabbit WHERE rabbitId=". $rabbitId;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");
}


function escapeInsert($conn,$insert) {
    $insert = htmlspecialchars($insert);

    $insert = mysqli_real_escape_string($conn,$insert);

    return $insert;
}
