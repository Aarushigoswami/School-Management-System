<?php
include 'db.php';

if (isset($_GET['name'])) {
    $all = $_GET['name'];
} else {
    $all = '';
}
$sql = "SELECT * FROM teachers WHERE teacher_id LIKE '$all%' OR email LIKE '$all%' OR teacher_name LIKE '$all%' ORDER BY teacher_id ASC";

$result = $conn->query($sql);

echo "<table border='1' cellpadding='5' cellspacing='0' class='table table-bordered table-striped'>";
echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['teacher_id']}</td>
            <td>{$row['teacher_name']}</td>
            <td>{$row['email']}</td>
            <td>
                <a href='edit_teacher.php?id={$row['teacher_id']}' class='btn btn-sm btn-warning'>Edit</a>
                <a href='delete_teacher.php?id={$row['teacher_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\");'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";
?>
