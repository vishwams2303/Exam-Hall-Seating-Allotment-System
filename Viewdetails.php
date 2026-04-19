<?php
include("../config/db.php");

if (!isset($_GET['id'])) {
    echo "Invalid Request";
    exit();
}

$reg_no = $_GET['id'];

$sql = "SELECT 
            s.reg_no,
            s.name AS student_name,
            s.department,
            s.year,
            h.hall_name,
            se.seat_no,
            se.exam_date,
            st.name AS staff_name,
            st.department AS staff_dept,
            st.phone
        FROM students s
        JOIN seating se ON s.id = se.student_id
        JOIN halls h ON se.hall_id = h.id
        LEFT JOIN staff_allocation sa 
            ON sa.hall_id = h.id AND sa.exam_date = se.exam_date
        LEFT JOIN staff st ON sa.staff_id = st.id
        WHERE s.reg_no = '$reg_no'";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "No data found";
    exit();
}

$row = $result->fetch_assoc();
?>

<h2>Student Full Details</h2>

<table border="1" cellpadding="10">
<tr><th>Register No</th><td><?php echo $row['reg_no']; ?></td></tr>
<tr><th>Name</th><td><?php echo $row['student_name']; ?></td></tr>
<tr><th>Department</th><td><?php echo $row['department']; ?></td></tr>
<tr><th>Year</th><td><?php echo $row['year']; ?></td></tr>

<tr><th>Hall</th><td><?php echo $row['hall_name']; ?></td></tr>
<tr><th>Seat No</th><td><?php echo $row['seat_no']; ?></td></tr>
<tr><th>Exam Date</th><td><?php echo $row['exam_date']; ?></td></tr>

<tr><th>Staff</th><td><?php echo $row['staff_name'] ?? 'Not Assigned'; ?></td></tr>
<tr><th>Staff Dept</th><td><?php echo $row['staff_dept'] ?? '-'; ?></td></tr>
<tr><th>Staff Phone</th><td><?php echo $row['phone'] ?? '-'; ?></td></tr>
</table>

<br>
<a href="view_seating.php">⬅ Back</a>