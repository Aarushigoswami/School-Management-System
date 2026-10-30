<?php
include 'db.php';
if ($_POST) {
    $subject_name = $_POST['subject_name'];
    $class_id = (int)$_POST['class_id'];
    $teacher_id = isset($_POST['teacher_id']) && $_POST['teacher_id'] != "" ? (int)$_POST['teacher_id'] : null;

    $stmt = $conn->prepare("INSERT INTO subjects (subject_name, class_id, teacher_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $subject_name, $class_id, $teacher_id);
    $stmt->execute();
    $stmt->close();

    header('Location: add_subject.php');
    exit;
}
$classes = $conn->query("SELECT * FROM classes");
$teachers = $conn->query("SELECT * FROM teachers");

$subjects = $conn->query("
    SELECT s.subject_id, s.subject_name, c.class_name, c.division, t.teacher_name
    FROM subjects s
    LEFT JOIN classes c ON s.class_id = c.class_id
    LEFT JOIN teachers t ON s.teacher_id = t.teacher_id
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Subjects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navigation.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Manage Subjects</h2>

    
    <form method="post" class="mb-4">
        <div class="mb-3">
            <label class="form-label">Subject Name</label>
            <input type="text" name="subject_name" class="form-control" placeholder="Enter subject name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="class_id" class="form-select" required>
                <option value="">Select Class</option>
                <?php while($c = $classes->fetch_assoc()): ?>
                    <option value="<?php echo $c['class_id']; ?>"><?php echo $c['class_name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Teacher</label>
            <select name="teacher_id" class="form-select">
                <option value="">Select Teacher</option>
                <?php while($t = $teachers->fetch_assoc()): ?>
                    <option value="<?php echo $t['teacher_id']; ?>"><?php echo $t['teacher_name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Subject</button>
    </form>

    <h3>Subject List</h3>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Subject Name</th>
                <th>Class-Division</th>
                <th>Class Number</th>
                <th>Teacher</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $subjects->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['subject_id']; ?></td>
                    <td><?php echo $row['subject_name']; ?></td>
                    <td><?php echo $row['class_name']; ?></td>
                    <td><?php echo $row['division']; ?></td>
                    <td><?php echo $row['teacher_name']; ?></td>
                    <td>
                        <a href="view.php?id=<?php echo $row['subject_id']; ?>" class="btn btn-sm btn-info">View</a>
                        <a href="edit_subject.php?id=<?php echo $row['subject_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete_subject.php?id=<?php echo $row['subject_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
