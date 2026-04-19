<?php include("../config/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add Student</h2>

<form method="POST">
    Register No: <input type="text" name="reg_no" required><br><br>
    Name: <input type="text" name="name" required><br><br>
    Department: <input type="text" name="department" required><br><br>
    Year: <input type="number" name="year" required><br><br>
    
    <input type="submit" name="submit" value="Add Student">
</form>

</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $reg_no = $_POST['reg_no'];
    $name = $_POST['name'];
    $dept = $_POST['department'];
    $year = $_POST['year'];

    $sql = "INSERT INTO students (reg_no, name, department, year)
            VALUES ('$reg_no', '$name', '$dept', '$year')";

    if ($conn->query($sql)) {
        echo "Student Added Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>