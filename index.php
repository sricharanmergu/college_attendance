 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


</head>
<body style="margin: 50px;">
<div class="container my-5">
    <h1>List of students</h1>
    <a class="btn btn-primary" href="/mystore/create.php" role="button"> New Student</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th> 
            </tr>
        </thead>

        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "mystore";

            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error){
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM employees";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/mystore/edit.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='/mystore/delete.php?id=$row[id]'>Delete</a> 
                </td>
            </tr>";

            }

            ?>
        </tbody>
    </table>
</div>
</body>
</html>