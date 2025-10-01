<?php
session_start();
$admin_fatch = $_SESSION['admin_log']['name'];
$student_fatch = $_SESSION['fatch_data']['student_id'];
include('conn.php');

if(empty($_SESSION['admin_log'])) {
    header('location:teacher_log.php');
    exit();
}

// Check if student is registered this semester
$sql = "SELECT * FROM course_taken WHERE student_id = '$student_fatch'";
$result_check_std = mysqli_query($conn, $sql);
if(mysqli_num_rows($result_check_std) <= 0) {
    $error_msg = "Sorry! This Student is Not Registered this Semester.";
}

// Initialize semester variable
$semester = "";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert Result</title>
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
        <label >Teacher panel</label></br>
            <a href="teacher_home.php" class="list_item_home">Home</a>
            <a href="insert_result_home.php" class="list_item_home">Insert Result</a>
            <a href="search.php" class="list_item_home">Result view</a>
            <a href="attend_home.php" class="list_item_home">Attendance</a>
            <a href="teacher_reset_pass.php" class="list_item_home">Change Password</a>
        </div>
    </div>
    <div id="container" class="right_part">
        <div id="welcome-message">
            <div id="Container">
                <h3 style="padding:10px; border-bottom:2px solid rgb(17,143,143); color:rgb(17,143,143);">Insert Course Marks</h3>
                <?php if(isset($error_msg)) { ?>
                    <label style="color:red; display:block; margin-top:30px;"><?php echo $error_msg; ?></label>
                <?php } ?>

                <form action="insert_result.php" method="POST">
                    <div id="pro_border" class="attend_sec_1">
                        <div class="attend_box_middle">
                            <?php
                            if(isset($_POST['submit'])){
                                $student_id = $_POST['student_id'];
                                $batch = $_POST['batch_id'];
                                $section = $_POST['section'];
                                $course_id = $_POST['course_id'];
                                $marks = $_POST['marks'];
                                $semester_input = $_POST['semester'];

                                // Check if marks already uploaded
                                $already_sql = "SELECT student_id, course_id FROM result WHERE student_id='$student_fatch' AND course_id='$course_id'";
                                $already_result = mysqli_query($conn,$already_sql);

                                if(mysqli_num_rows($already_result) > 0){
                                    echo "<p style='color:red; font-weight:bold; text-align:center; margin-bottom:20px;'>Marks Already Uploaded!</p>";
                                } elseif($marks > 100){
                                    echo "<p style='color:red; font-weight:bold; text-align:center; margin-bottom:20px;'>Input Marks is greater than Limit.</p>";
                                } else {
                                    $sql_insert = "INSERT INTO result(student_id, course_id, batch, section, marks, semester) 
                                                   VALUES ('$student_id','$course_id','$batch','$section','$marks','$semester_input')";
                                    mysqli_query($conn, $sql_insert);
                                    echo "<p style='color:green; font-weight:bold; text-align:center; margin-bottom:20px;'>Marks Inserted! <br>Input mark is $marks</p>";

                                    // Update grade
                                    if($marks < 40){
                                        $grade = 'F'; $points='0.00';
                                    } elseif($marks >= 40 && $marks < 50){
                                        $grade = 'D'; $points='2.00';
                                    } elseif($marks >= 50 && $marks < 60){
                                        $grade = 'C'; $points='2.50';
                                    } elseif($marks >= 60 && $marks < 70){
                                        $grade = 'B'; $points='3.00';
                                    } elseif($marks >= 70 && $marks < 80){
                                        $grade = 'A'; $points='3.50';
                                    } elseif($marks >= 80 && $marks <= 100){
                                        $grade = 'A+'; $points='4.00';
                                    }

                                    $sql_update_grade = "UPDATE result SET grade='$grade', points='$points' WHERE course_id='$course_id' AND student_id='$student_id'";
                                    mysqli_query($conn, $sql_update_grade);
                                }
                            }

                            // Fetch student info
                            $sql_student = "SELECT * FROM student_info WHERE student_id='$student_fatch'";
                            $result_student = mysqli_query($conn, $sql_student);
                            if(mysqli_num_rows($result_student) > 0){
                                $student_data = mysqli_fetch_assoc($result_student);
                                $student_id = $student_data['student_id'];
                                $batch_id = $student_data['batch'];
                                $section = $student_data['section'];
                            }

                            // Fetch semester from course_taken table if available
                            $sql_course = "SELECT * FROM course_taken WHERE student_id='$student_fatch' LIMIT 1";
                            $result_course = mysqli_query($conn, $sql_course);
                            if(mysqli_num_rows($result_course) > 0){
                                $course_data = mysqli_fetch_assoc($result_course);
                                $semester = $course_data['semester'];
                            } else {
                                $semester = ""; // default if no course
                            }
                            ?>

                            <label for="student_id">Student ID:</label>
                            <input type="text" name="student_id" id="course_box" value="<?php echo $student_id ?>" required>

                            <label for="batch_id">Batch ID:</label>
                            <input type="text" name="batch_id" id="course_box" value="<?php echo $batch_id ?>" required>

                            <label for="section">Section:</label>
                            <input type="text" name="section" id="course_box" value="<?php echo $section ?>" required>

                            <label for="course_id">Course ID:</label>
                            <select id="course_box" name="course_id" required>
                                <option value="">Select Course</option>
                                <?php
                                $sql_courses = "SELECT * FROM course_taken WHERE student_id='$student_fatch'";
                                $result_courses = mysqli_query($conn, $sql_courses);
                                if(mysqli_num_rows($result_courses) > 0){
                                    while($course = mysqli_fetch_assoc($result_courses)){
                                        $course_id_opt = $course['course_id'];
                                        $course_name = $course['course_name'];
                                        echo "<option value='$course_id_opt'>$course_id_opt ($course_name)</option>";
                                    }
                                }
                                ?>
                            </select>

                            <label for="semester">Semester:</label>
                            <input type="text" name="semester" id="course_box" value="<?php echo $semester ?>" required>

                            <label for="marks">Marks:</label>
                            <input type="text" name="marks" id="course_box" placeholder="Input Marks" required>

                            <input type="submit" name="submit" id="search_sub submit_shadow" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>
