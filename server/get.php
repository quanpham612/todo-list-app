<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
include 'db.php';

$page = (isset($_GET['page']) ? (int) $_GET['page'] : 1);
$tasks_per_page = (isset($_GET['tasksPerPage']) && (int) $_GET['tasksPerPage'] <= 50 ? (int) $_GET['tasksPerPage'] : 5);
$start = ($page > 1) ? ($page * $tasks_per_page) - $tasks_per_page : 0;

$sql_query = "select * from tasks limit ".$start.", ".$tasks_per_page." ";
$number_of_tasks = $db->query("select * from tasks")->num_rows;
$number_of_pages = ceil($number_of_tasks/$tasks_per_page);
$rows = $db->query($sql_query);

$taskData = [];

while ($row = mysqli_fetch_array($rows, MYSQLI_ASSOC)) {
	$data[] = $row;
}

$response["status"] = "true";
$response["message"] = "good";
$response["taskData"] = $data;
$response["numberOfPage"] = $number_of_pages;

echo json_encode($response);
exit;