<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mystore";
// Create connection
$connection = new mysqli($servername, $username, $password, $database);



$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ){
if ( !isset($_GET["id"]) ){
    header("location: /mystore/index.php");
    exit;
}

$id = $_GET["id"];

$sql = "SELECT * FROM employees WHERE id=$id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    header("location: /mystore/index.php");
    exit;
}

$name = $row["name"];
$email = $row["email"];
$phone = $row["phone"];
$address = $row["address"];

}
else {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do{
        if ( empty($id) || empty($name) || empty($email) || empty($phone) || empty($address) ){
            $errorMessage = "ALL THE FIELDS ARE REQUIRED";
            break;
        }
        $sql = "UPDATE employees " .
        "SET name = '$name', email = '$email', phone = '$phone', address = '$address' " .
        "WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query " . $connection->error;
            break;
        }

        $successMessage = "Student updated correctly";
        header("location: /mystore/index.php");
        exit;
        

     } while (false);
    

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Student</h2>

        <?php
        if ( !empty($errorMessage) ){
            echo "
            <div class='alert alert-warning alert-dismissble fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>


        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">email</label>
                <div class="col-sm-6">
                    <input type="text" class="form control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Adress</label>
                <div class="col-sm-6">
                    <input type="text" class="form control" name="address" value="<?php echo $address ?>">
                </div>
            </div>

            <?php
            if ( !empty($successMessage) ){
                echo "
                <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                </div>
                </div>";
            
            
            }
            ?>


            <div class="row  mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="index.php/" role="button">Cancel</a>
            </div>
            </div>
        </form>
    </div>
</body>
</html>