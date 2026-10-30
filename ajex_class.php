<?php
include 'db.php';

if (isset($_GET['name'])) {
    $all = $_GET['name'];
} else {
    $all = '';
}
$sql = "SELECT * FROM classes 
        WHERE division LIKE '$all%' OR class_name LIKE '$all%' 
        ORDER BY class_id ASC";

$result = $conn->query($sql);

echo "<table border='1' cellpadding='5' cellspacing='0' class='table table-bordered table-striped'>";
echo "<tr>
        <th>ID</th>
        <th>Class Name</th>
        <th>Class Number</th>
        <th>Actions</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['class_id']}</td>
            <td>{$row['class_name']}</td>
            <td>{$row['division']}</td>
            <td>
                <a href='edit_class.php?id={$row['class_id']}' class='btn btn-sm btn-warning'>Edit</a>
                <a href='delete_class.php?id={$row['class_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\");'>Delete</a>
            </td>
          </tr>";
}
echo "</table>";
?>
