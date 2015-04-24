<?php
require_once(__DIR__ . '/tests/db.class.php');

// Database connection details
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');

// MYSQL database connection
$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Error ' . mysqli_error($mysqli));

// $user_array = db::select($mysqli, 'user');
// echo '<pre>' . print_r($user_array, 1) . '</pre>';

// $data = [
// 	'name_first' => ['s', 'James'],
// 	'name_last'  => ['s', 'Blanksby'],
// 	'email'      => ['s', 'james@blanks.by'],
// 	'password'   => ['s', 'pass']
// ];
// db::insert($mysqli, 'user', $data);

// $data = [
// 	'name_first' => ['s', 'James']
// ];
// db::update($mysqli, 'user', $data, ['id' => 106]);

// db::delete($mysqli, 'user', ['id' => 110]);

// $result = db::raw($mysqli, 'SELECT * FROM user');
// while($user = $result->fetch_object()) :
// 	echo '<pre>' . print_r($user, 1) . '</pre>';
// endwhile;
?>