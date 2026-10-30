<?php
include 'db.php';

$id = $_GET['id'];

if ($_POST) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $conn->query("UPDATE teachers SET teacher_name='$name', email='$email' WHERE teacher_id=$id");
  header('Location: add_teacher.php');
  exit;
}

$teacher = $conn->query("SELECT * FROM teachers WHERE teacher_id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include 'navigation.php'; ?>
<div class="container mt-4">
    <h2 class="mb-3">Edit Teacher</h2>
    <form method="post" class="p-4 bg-white rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" value="<?php echo $teacher['teacher_name']; ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" value="<?php echo $teacher['email']; ?>" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update Teacher</button>
        <a href="add_teacher.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
