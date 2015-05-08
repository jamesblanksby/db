<?php
require_once(__DIR__ . '/../db.class.php');

// Database connection details
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');

// MYSQL database connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Error ' . mysqli_error($mysqli));

$user_array = db::select($mysqli, 'user');
// echo '<pre>' . print_r($user_array, 1) . '</pre>';

// $data = [
// 	'name_first' => ['s', 'James'],
// 	'name_last'  => ['s', 'Blanksby'],
// 	'email'      => ['s', 'james@blanks.by'],
// 	'password'   => ['s', 'pass']
// ];
// db::insert($mysqli, 'user', $data);

// $data = [
// 	'password' => ['s', 'bUc0It8bOf']
// ];
// db::update($mysqli, 'user', $data, ['id' => 45]);

// db::delete($mysqli, 'user', ['id' => 45]);

// $result = db::raw($mysqli, 'SELECT * FROM user');
// while($user = $result->fetch_object()) :
// 	echo '<pre>' . print_r($user, 1) . '</pre>';
// endwhile;
?>