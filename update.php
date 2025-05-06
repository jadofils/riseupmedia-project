<?php
session_start();
include("./db/connect.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("<p style='color:red;'>Invalid or missing student ID.</p>");
}

$id = intval($_GET['id']);

$selectQuery = "SELECT * FROM student WHERE id=$id";
$result = mysqli_query($conn, $selectQuery);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("<p style='color:red;'>Student not found.</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
</head>
<body>

<a href="./select.php">View All Students</a>

<form action="./backend/update.php" method="POST">
    <?php
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        foreach ($_SESSION['error'] as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
        unset($_SESSION['error']);
    }
    ?>
    
    <h3>Update Student</h3>

    Id: <input type="number" id="id" class="id" value="<?php echo $row['id']; ?>" name="id" readonly><br><br>
    First Name: <input type="text" name="fname" class="fname" id="fname" value="<?php echo $row['fname']; ?>"><br><br>
    Last Name: <input type="text" name="lname" class="lname" id="lname" value="<?php echo $row['lname']; ?>"><br><br>
    Email: <input type="email" name="email" id="email" class="email" value="<?php echo $row['email']; ?>"><br><br>
    Password: <input type="password" name="password" id="password" class="password" value="<?php echo $row['password']; ?>"><br><br>

    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
