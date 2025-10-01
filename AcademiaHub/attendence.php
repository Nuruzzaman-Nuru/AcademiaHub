<?php
session_start();
include("conn.php");

if (empty($_SESSION['admin_log'])) {
    header('location:teacher_log.php');
    exit;
}

if (empty($_SESSION['fatch_student_info']) || empty($_SESSION['course_id'])) {
    header('location:attend_home.php');
    exit;
}

$fatch_course_taken = $_SESSION['fatch_student_info'];
$course_id = $_SESSION['course_id'];
$present_date = date("Y-m-d");

if (isset($_POST['submit'])) {
    // First, check if the table exists
    $check_table = $conn->query("SHOW TABLES LIKE 'attendence'");
    if (!$check_table) {
        die("Error checking table: " . $conn->error);
    }
    
    if ($check_table->num_rows == 0) {
        // Create table if it doesn't exist
        $create_table = "CREATE TABLE IF NOT EXISTS attendence (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            student_id INT(11),
            course_id VARCHAR(20),
            p_date DATE,
            attendence VARCHAR(10),
            UNIQUE KEY unique_attendance (student_id, course_id, p_date)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        if (!$conn->query($create_table)) {
            die("Error creating table: " . $conn->error);
        }
    }
    
    // Make sure we have a valid database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        // Prepare the statement with explicit error handling
        $query = "INSERT INTO attendence (student_id, course_id, p_date, attendence) 
                 VALUES (?, ?, ?, ?) 
                 ON DUPLICATE KEY UPDATE attendence = VALUES(attendence)";
        
        $stmt = $conn->prepare($query);
        if ($stmt === false) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }

        $success_count = 0;
        foreach ($fatch_course_taken as $student) {
            $student_id = intval($student['student_id']);
            $attendance_status = isset($_POST["attendance_" . $student_id]) ? $_POST["attendance_" . $student_id] : 'Absent';
            
            // Debug output
            echo "<!-- Debug: student_id: $student_id, course_id: $course_id, date: $present_date, status: $attendance_status -->";
            
            if (!$stmt->bind_param("isss", $student_id, $course_id, $present_date, $attendance_status)) {
                throw new Exception('Binding parameters failed: ' . $stmt->error);
            }
            
            if (!$stmt->execute()) {
                throw new Exception('Execute failed: ' . $stmt->error);
            }
            
            $success_count++;
        }
        
        if ($success_count > 0) {
            $success_msg = "Attendance Taken Successfully for $success_count students!";
        }
    } catch (Exception $e) {
        $error_msg = "Error: " . $e->getMessage();
        echo "<!-- Debug Error: " . htmlspecialchars($error_msg) . " -->";
    }

    if ($success_count > 0) {
        $success_msg = "Attendance Taken Successfully for $success_count students!";
    } else {
        $success_msg = "Error taking attendance. Please try again.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="header">
    <div class="admin_class"><a href="teacher_logout.php">Logout</a></div>
    <h1>Student Portal</h1>
</div>

<div class="body_section">
    <div id="container" class="left_part">
        <div class="list_item_home_content">
            <a href="teacher_home.php" class="list_item_home">Home</a>
            <a href="insert_result_home.php" class="list_item_home">Insert Result</a>
            <a href="search.php" class="list_item_home">Result view</a>
            <a href="attend_home.php" class="list_item_home">Attendance</a>
            <a href="teacher_reset_pass.php" class="list_item_home">Change Password</a>
        </div>
    </div>
    <div id="container" class="right_part">
        <div id="attendence_body">
            <h3 style="padding:10px;border-bottom:2px solid rgb(17, 143, 143);color:rgb(17, 143, 143);text-align:center;font-size:25px">Student Attendance</h3>
            <div class="student_list">
            <label style="color:red;display:block;margin:50px 20px;"><?php if (isset($success_msg)) echo $success_msg; ?></label>
                    <form action="attendence.php" method="POST">
                        <label style="display:block;padding:10px;text-align:center;font-size:18px;color:#b90000;text-shadow:3px 2px 8px #b90033"><?php echo $present_date; ?></label>
                        <table>
                            <tr>
                                <th style="padding:10px 15px;background-color:#91e989a2;">Student ID</th>
                                <th style="padding:10px 15px;background-color:#3a558ea1;">Student Name</th>
                                <th style="padding:10px 15px;background-color:#90d98952;">Course Name</th>
                                <th style="padding:10px 15px;background-color:#11c989a2;">Attendance Section</th>
                            </tr>
                            <?php foreach ($fatch_course_taken as $student): ?>
                                <tr>
                                    <td style="padding:10px 45px;background-color:#ccc;"><?php echo $student['student_id']; ?></td>
                                    <td style="padding:10px 45px;background-color:#ccc;"><?php echo $student['first_name']; ?></td>
                                    <td style="padding:10px 45px;background-color:#ccc;"><?php echo $student['course_name']; ?></td>
                                    <td style="padding:10px 35px;background-color:#ccc;">
                                        <?php 
                                        // Check if attendance already exists for this student on this date
                                        $existing_attendance = null;
                                        $check_sql = "SELECT attendence FROM attendence WHERE student_id = ? AND course_id = ? AND p_date = ?";
                                        $check_stmt = $conn->prepare($check_sql);
                                        
                                        if ($check_stmt === false) {
                                            echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
                                        } else {
                                            if (!$check_stmt->bind_param("iss", $student['student_id'], $course_id, $present_date)) {
                                                echo "Binding parameters failed: (" . $check_stmt->errno . ") " . $check_stmt->error;
                                            } else {
                                                if (!$check_stmt->execute()) {
                                                    echo "Execute failed: (" . $check_stmt->errno . ") " . $check_stmt->error;
                                                } else {
                                                    $result = $check_stmt->get_result();
                                                    $existing_attendance = $result->fetch_assoc();
                                                }
                                            }
                                            $check_stmt->close();
                                        }
                                        ?>
                                        <input type="radio" name="attendance_<?php echo $student['student_id']; ?>" value="Present" required <?php if($existing_attendance && $existing_attendance['attendence'] == 'Present') echo 'checked'; ?>> Present
                                        <input type="radio" name="attendance_<?php echo $student['student_id']; ?>" value="Absent" required <?php if($existing_attendance && $existing_attendance['attendence'] == 'Absent') echo 'checked'; ?>> Absent
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                        <input style="display:block;margin:20px auto;" type="submit" id="search_sub submit_shadow" name="submit" value="Submit">
                    </form>
            </div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>