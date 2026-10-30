<?php
include 'db.php';

if (isset($_GET['name'])) {
    $all = $_GET['name'];
} else {
    $all = '';
}
$sql = "SELECT s.subject_name, c.class_name, c.division, t.teacher_name 
        FROM subjects s 
        LEFT JOIN classes c ON s.class_id = c.class_id 
        LEFT JOIN teachers  t ON s.teacher_id = t.teacher_id
        WHERE s.subject_name LIKE '$all%' OR c.class_name LIKE '$all%' OR c.division LIKE '$all%'OR t.teacher_name LIKE '$all%' ";
$result = $conn->query($sql);
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Subject Name</th><th>Class</th><th>Division</th><th>Teacher</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>"
            . "<td>" . $row['subject_name'] . "</td>"
            . "<td>" . $row['class_name'] . "</td>"
            . "<td>" . $row['division'] . "</td>"
            . "<td>" . $row['teacher_name'] . "</td>"
            . "</tr>";
}
echo "</table>";
?>
