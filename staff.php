<?php
include("../config/db.php");

// Fetch staff & halls
$staffs = $conn->query("SELECT * FROM staff");
$halls = $conn->query("SELECT * FROM halls");
?>

<h2>Allocate Staff</h2>

<form method="POST">
    Staff:
    <select name="staff_id">
        <?php while($s = $staffs->fetch_assoc()) { ?>
            <option value="<?php echo $s['id']; ?>">
                <?php echo $s['name']; ?>
            </option>
        <?php } ?>
    </select><br><br>

    Hall:
    <select name="hall_id">
        <?php while($h = $halls->fetch_assoc()) { ?>
            <option value="<?php echo $h['id']; ?>">
                <?php echo $h['hall_name']; ?>
            </option>
        <?php } ?>
    </select><br><br>

    Exam Date:
    <input type="date" name="exam_date" required><br><br>

    <input type="submit" name="submit" value="Allocate">
</form>

<?php
if (isset($_POST['submit'])) {
    $staff_id = $_POST['staff_id'];
    $hall_id = $_POST['hall_id'];
    $date = $_POST['exam_date'];

    $sql = "INSERT INTO staff_allocation (staff_id, hall_id, exam_date)
            VALUES ('$staff_id', '$hall_id', '$date')";

    if ($conn->query($sql)) {
        echo "Staff Allocated Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>