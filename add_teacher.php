<?php
include 'db.php';

if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO teachers (teacher_name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $stmt->close();

    header('Location: add_teacher.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Teachers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        table th {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
<?php include 'navigation.php'; ?>

<div class="container mt-4">
    <h2 class="mb-4">Manage Teachers</h2>

    <form method="post" class="mb-4">
        <div class="mb-3">
            <label for="name" class="form-label">Teacher Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter teacher name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Teacher Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Teacher</button>
    </form>

    <input type="text" 
           id="teacher-search" 
           onkeyup="getTeacher(this.value)" 
           placeholder="Search Teacher Details"
           class="form-control mb-3"/>

    

    <div id="teacher-data"></div>
</div>

<script>
    function getTeacher(name) {
        let obj = new XMLHttpRequest();
        obj.open("GET", "ajex_teacher.php?name=" + encodeURIComponent(name), true);
        obj.send();

        obj.onreadystatechange = function () {
            if (obj.readyState === 4 && obj.status === 200) {
                document.getElementById('teacher-data').innerHTML = obj.responseText;
            }
        };
    }

   window.onload = function() {
    getTeacher('');
};


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
