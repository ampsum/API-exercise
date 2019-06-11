<?php
/*
 * Visar alla kunder
*/
function getAllCustomers($conn){
    $query = "SELECT * FROM customer ORDER BY customerName ASC";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $row = mysqli_fetch_all($result);

    return $row;
}

/*
 * Hämtar en kund
 */
function getCustomerData($conn,$customerId){
    $query = "SELECT * FROM customer
			WHERE customerId=".$customerId;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $row = mysqli_fetch_all($result);

    return $row;
}

/*
 * Sparar en kund
*/
function saveCustomer($conn){
    $date = date("Y-m-d H:i:s");
    $name = escapeInsert($conn,$_POST['customerName']);
    $email = escapeInsert($conn,$_POST['customerEmail']);
    $password = escapeInsert($conn,$_POST['customerPassword']);
    // Sparar lösenordet med password_hash
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO customer
			(customerName,customerEmail,customerPassword,customerDate)
			VALUES('$name','$email','$passwordHash','$date')";

    $result = mysqli_query($conn,$query) or die("Query failed: $query");

    $insId = mysqli_insert_id($conn);

    return $insId;
}

/*
 * Uppdaterar en kund
*/
function updateCustomer($conn){
    $name = escapeInsert($conn,$_POST['txtName']);
    $email = escapeInsert($conn,$_POST['txtEmail']);
    $editid = $_POST['updateid'];

    $query = "UPDATE customer
			SET customerName='$name', customerEmail='$email'
			WHERE customerId=". $editid;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");
}

/*
 * Raderar kund
*/
function deleteCustomer($conn,$customerId){
    $query = "DELETE FROM customer WHERE customerId=". $customerId;

    $result = mysqli_query($conn,$query) or die("Query failed: $query");
}

/*
 * Tar bort oönskade html-tecken
 *
 * mysqli_real_escape_string motverkar SQLInjection
 */
function escapeInsert($conn,$insert) {
    $insert = htmlspecialchars($insert);

    $insert = mysqli_real_escape_string($conn,$insert);

    return $insert;
}
