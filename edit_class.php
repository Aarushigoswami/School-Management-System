<?php
include 'db.php';

$id = $_GET['id'];

if ($_POST) {
  $class_name = $_POST['class_name'];
  $division = $_POST['division'];
  $conn->query("UPDATE classes SET class_name='$class_name', division='$division' WHERE class_id=$id");
  header('Location: add_class.php');
  exit;
}

$class = $conn->query("SELECT * FROM classes WHERE class_id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include 'navigation.php'; ?>
<div class="container mt-4">
    <h2 class="mb-3">Edit Class</h2>
    <form method="post" class="p-4 bg-white rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Class Name</label>
            <input name="class_name" value="<?php echo $class['class_name']; ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Division</label>
            <input name="division" value="<?php echo $class['division']; ?>" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update Class</button>
        <a href="add_class.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
