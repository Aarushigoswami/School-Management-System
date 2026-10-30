<?php
include 'db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM subjects WHERE subject_id=$id");
header('Location: add_subject.php');
exit;
