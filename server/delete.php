<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
include 'db.php';

$id = (int) $_GET['id'];
$sql_query = "delete from tasks where id = '$id'";
$is_del_success = $db->query($sql_query);
if ($is_del_success) {
    header('location: http://localhost:3000');
}