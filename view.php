<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("Subject ID not provided.");
}

$subject_id = (int)$_GET['id'];

// Get Subject Details
$subject_query = $conn->query("
    SELECT s.subject_id, s.subject_name, s.class_id, s.teacher_id,
           c.class_name, c.division, t.teacher_name
    FROM subjects s
    LEFT JOIN classes c ON s.class_id = c.class_id
    LEFT JOIN teachers t ON s.teacher_id = t.teacher_id
    WHERE s.subject_id = $subject_id
");

if ($subject_query->num_rows == 0) {
    die("Subject not found.");
}

$subject = $subject_query->fetch_assoc();

// Get Teacher Details
$teacher = null;
if ($subject['teacher_id']) {
    $teacher_query = $conn->query("SELECT * FROM teachers WHERE teacher_id = {$subject['teacher_id']}");
    $teacher = $teacher_query->fetch_assoc();
}

// Get Class Details
$class = null;
if ($subject['class_id']) {
    $class_query = $conn->query("SELECT * FROM classes WHERE class_id = {$subject['class_id']}");
    $class = $class_query->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>View Subject Details</h2>
    <hr>

    <!-- Subject Details -->
    <h3>Subject Information</h3>
    <table class="table table-bordered">
        <tr><th>Name</th><td><?php echo $subject['subject_name']; ?></td></tr>
        <tr><th>Class-Division</th><td><?php echo $subject['class_name']; ?></td></tr>
        <tr><th>Class Number</th><td><?php echo $subject['division']; ?></td></tr>
        <tr><th>Teacher</th><td><?php echo $subject['teacher_name']; ?></td></tr>
    </table>

    <!-- Teacher Details -->
    <?php if ($teacher): ?>
        <h3>Teacher Details</h3>
        <table class="table table-bordered">
            <tr><th>Name</th><td><?php echo $teacher['teacher_name']; ?></td></tr>
            <tr><th>Email</th><td><?php echo $teacher['email']; ?></td></tr>
        </table>
    <?php else: ?>
        <p>No teacher assigned to this subject.</p>
    <?php endif; ?>

    <!-- Class Details -->
    <?php if ($class): ?>
        <h3>Class Details</h3>
        <table class="table table-bordered">
            <tr><th>Class Name-Division</th><td><?php echo $class['class_name']; ?></td></tr>
            <tr><th>Class Number</th><td><?php echo $class['division']; ?></td></tr>
            
        </table>
    <?php else: ?>
        <p>No class assigned to this subject.</p>
    <?php endif; ?>

    <a href="add_subject.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
