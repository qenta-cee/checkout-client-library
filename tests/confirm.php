<?php

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$array = $_GET;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$array = $_POST;
}

foreach($array as $key => $value) {
	file_put_contents('confirm.txt', date("d.m.Y H:i:s") . " - Key: {$key} => Value: {$value}". PHP_EOL, FILE_APPEND | LOCK_EX);
}