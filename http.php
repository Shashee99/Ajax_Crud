<?php

$connection = mysqli_connect("localhost", "root", "", "classicmodels");

if (isset($_POST["do_insert"]))
{
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];

$sql = "INSERT INTO `employees`(`lastName`, `firstName`) VALUES ('$last_name', '$first_name')";
mysqli_query($connection, $sql);

echo "Record has been inserted successfully.";
exit();
}



if (isset($_GET["view_all"]))
{
    $sql = "SELECT * FROM employees";
$result = mysqli_query($connection, $sql);

$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}


echo json_encode($data);
exit();
}

if(isset($_POST["do_delete"]))
{
$employee_id = $_POST["employee_id"];
$sql = "DELETE FROM employees WHERE employeeNumber = '" . $employee_id . "'";
mysqli_query($connection, $sql);

echo "Record has been deleted";
exit();
}

if(isset($_POST["doupdate"])){
    $updateId = $_POST['update_Id'];
    $sql = "SELECT * FROM employees WHERE employeeNumber = '" . $updateId . "'";
    $result=mysqli_query($connection, $sql);

    $row = mysqli_fetch_object($result);
    echo json_encode($row);
    exit();

}

if (isset($_POST["do_update"]))
{
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$employee_id = $_POST["employee_id"];

$sql = "UPDATE `employees` SET `lastName` = '$last_name', `firstName` = '$first_name' WHERE employeeNumber = '" . $employee_id . "'";
mysqli_query($connection, $sql);

echo "Record has been updated successfully.";
exit();
}