<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM teachers WHERE teacher_id=$id");
header('Location: add_teacher.php');
exit;
