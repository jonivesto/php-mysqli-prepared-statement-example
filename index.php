<?php include 'Database.php';

$values = array('Hello there!', 'General Kenobi!', 'You are a bold one..');

$database = new Database();
$database->insert($values);
$database->select();

