<?php
include 'db.php';

if ($_POST) {
    $class_name = $_POST['class_name'];
    $division = $_POST['division'];

    $sql ="INSERT INTO classes (class_name, division) VALUES ('$class_name','$division')";
   $result =  $conn->query($sql);
   
    

    header("Location: add_class.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Classes</title>
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
<div class="container">
    

    <?php include 'navigation.php'; ?>
    
    <h2 class="my-4">Manage Classes</h2>

    <form method="post" class="mb-4">
        <div class="mb-3">
            <label class="form-label">Class Name-Division</label>
            <input type="text" name="class_name" class="form-control" placeholder="Enter class name-Division" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Class Number</label>
            <input type="text" name="division" class="form-control" placeholder="Enter class Number">
        </div>
        <button type="submit" class="btn btn-primary">Add Class</button>
    </form>

    <input type="text" 
           id="class-search" 
           onkeyup="getClass(this.value)" 
           placeholder="Search Class Details"
           class="form-control mb-3"/>

    <div id="class-data"></div>
</div>

<script>
    function getClass(name) {
        let obj = new XMLHttpRequest();
        obj.open("GET", "ajex_class.php?name=" +name, true);
        obj.send();

        obj.onreadystatechange = function () {
            if (obj.readyState === 4 && obj.status === 200) {
                document.getElementById('class-data').innerHTML = obj.responseText;
            }
        };
    }

    window.onload = function() {
        getClass('');
    };
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
