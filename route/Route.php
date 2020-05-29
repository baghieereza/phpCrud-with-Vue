<?php
require_once ('../UsersController.php');



if($_GET['action'] && $_GET['action'] == 'read') {
    $users = new UsersController();
    $users->read();
}


if($_GET['action'] && $_GET['action'] == 'update') {
    $users = new UsersController();
    $users->update($_POST['id'],$_POST);
}


if($_GET['action'] && $_GET['action'] == 'create') {
    $users = new UsersController();
    $users->create($_POST);
}


if($_GET['action'] && $_GET['action'] == 'delete') {
    $users = new UsersController();
    $users->delete($_POST['id']);
}
