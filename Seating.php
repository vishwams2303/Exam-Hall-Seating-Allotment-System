<?php
include("../config/db.php");

// Get students
$students = $conn->query("SELECT * FROM students");

// Get halls
$halls = $conn->query("SELECT * FROM halls");

$hall_list = [];
while ($h = $halls->fetch_assoc()) {
    $hall_list[] = $h;
}

$hall_index = 0;
$seat_no = 1;

while ($student = $students->fetch_assoc()) {

    $current_hall = $hall_list[$hall_index];

    // Insert seating
    $conn->query("INSERT INTO seating (student_id, hall_id, seat_no, exam_date)
                  VALUES ('{$student['id']}', '{$current_hall['id']}', '$seat_no', CURDATE())");

    $seat_no++;

    // Move to next hall if capacity reached
    if ($seat_no > $current_hall['capacity']) {
        $hall_index++;
        $seat_no = 1;
    }
}

echo "Seating Generated Successfully!";
?>