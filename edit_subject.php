<?php
include 'db.php';

$id = $_GET['id'];

if ($_POST) {
  $subject_name = $_POST['subject_name'];
  $class_id = $_POST['class_id'];
  $teacher_id = $_POST['teacher_id'] ?: "NULL";
  $conn->query("UPDATE subjects SET subject_name='$subject_name', class_id=$class_id, teacher_id=$teacher_id WHERE subject_id=$id");
  header('Location: add_subject.php');
  exit;
}

$subject = $conn->query("SELECT * FROM subjects WHERE subject_id=$id")->fetch_assoc();
$classes = $conn->query("SELECT * FROM classes");
$teachers = $conn->query("SELECT * FROM teachers");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Subject</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include 'navigation.php'; ?>
<div class="container mt-4">
    <h2 class="mb-3">Edit Subject</h2>
    <form method="post" class="p-4 bg-white rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label">Subject Name</label>
            <input name="subject_name" value="<?php echo $subject['subject_name']; ?>" required class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="class_id" required class="form-select">
                <?php while($c = $classes->fetch_assoc()){ ?>
                    <option value="<?php echo $c['class_id']; ?>" <?php echo $c['class_id'] == $subject['class_id'] ? 'selected' : ''; ?>>
                        <?php echo $c['class_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Teacher</label>
            <select name="teacher_id" class="form-select">
                <option value="">No Teacher</option>
                <?php while($t = $teachers->fetch_assoc()){ ?>
                    <option value="<?php echo $t['teacher_id']; ?>" <?php echo $t['teacher_id'] == $subject['teacher_id'] ? 'selected' : ''; ?>>
                        <?php echo $t['teacher_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Subject</button>
        <a href="add_subject.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
