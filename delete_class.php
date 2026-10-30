<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM classes WHERE class_id=$id");
header('Location: add_class.php');
exit;
