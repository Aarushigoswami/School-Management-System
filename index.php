<?php
include 'db.php';
include 'navigation.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        h2 {
            font-weight: bold;
        }
        #work-entry-search {
            max-width: 400px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #fff;
        }
        table th {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: left;
        }
        table td {
            padding: 10px;
            border: 1px solid #dee2e6;
        }
        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="my-4">Dashboard</h2>

    <input type="text" 
           id="work-entry-search" 
           onkeyup="getWorker(this.value)" 
           placeholder="Search Subject Details"
           class="form-control mb-3"/>

    

    <div class="table-section" id="data"></div>
</div>

<script>
    function getWorker(name) {
        let obj = new XMLHttpRequest();
        obj.open("GET", "ajex_index.php?name=" + name, true);
        obj.send();

        obj.onreadystatechange = function () {
            if (obj.readyState === 4 && obj.status === 200) {
                document.getElementById('data').innerHTML = obj.responseText;
            }
        };
    }

    
    window.onload = function() {
        getWorker('');
    };
</script>
</body>
</html>
