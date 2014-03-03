<?php

if($_GET['action'] == '' && $_POST['action'] == '') die();

include_once '../classes/UsersController.php';
$users = new UsersController();

$action = $_GET['action'];

if($_GET['id'] && $_GET['number'] && $_GET['name'] && $_GET['prefix'] && $_GET['password']) {
    $id = $_GET['id'];
    $number = $_GET['number'];
    $name = $_GET['name'];
    $password = $_GET['password'];
    $prefix = $_GET['prefix'];
    $users->$action($id,$number,$name,$password,$prefix);
} else if($_GET['number'] && $_GET['name'] && $_GET['prefix'] && $_GET['password']) {
    $number = $_GET['number'];
    $name = $_GET['name'];
    $password = $_GET['password'];
    $prefix = $_GET['prefix'];
    $users->$action($number,$name,$password,$prefix);
} else if($_GET['number']) {
    $number = $_GET['number'];
    $users->$action($number);
} else if($_GET['id'] && $_GET['value']) {
    $id = $_GET['id'];
    $value = $_GET['value'];
    $value = substr($value, -1);
    $value = ($value-1)*-1;
    $users->$action($id,$value);
} else if($_GET['id']) {
    $id = $_GET['id'];
    $users->$action($id);
} else if($_GET['numbers']) {
    $userList = $_GET['numbers'];
    $users->$action($userList);
} else if($_POST['pk'] && $_POST['name']) {
    $pk = $_POST['pk'];
    $name = $_POST['name'];
    $value = $_POST['value'];
    $users->$action($pk, $name, $value);
} else if($_POST['action'] === "CSVImport") {
    $file = $_FILES['filename']['tmp_name'];
    $users->CSVImport($file);
} else {
   $users->$action();
}
