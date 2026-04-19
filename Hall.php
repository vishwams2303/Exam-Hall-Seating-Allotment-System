<?php include("../config/db.php"); ?>

<h2>Add Hall</h2>

<form method="POST">
    Hall Name: <input type="text" name="hall_name" required><br><br>
    Capacity: <input type="number" name="capacity" required><br><br>

    <input type="submit" name="submit" value="Add Hall">
</form>

<?php
if (isset($_POST['submit'])) {
    $hall = $_POST['hall_name'];
    $capacity = $_POST['capacity'];

    $sql = "INSERT INTO halls (hall_name, capacity)
            VALUES ('$hall', '$capacity')";

    if ($conn->query($sql)) {
        echo "Hall Added!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>