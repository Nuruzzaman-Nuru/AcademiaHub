<?php
session_start();
include('conn.php');

// Check if user is logged in and is admin
if(empty($_SESSION['admin_log']) || !isset($_SESSION['admin_log']['admin_position']) || $_SESSION['admin_log']['admin_position'] !== 'Admin') {
    header('location:admin_log.php');
    exit();
}

$admin_fatch = $_SESSION['admin_log']['name'];
$conform_mgs = "";
$error_conform_mgs = "";

if(isset($_POST['submit'])) {
    // Validate form inputs
    $errors = [];
    
    // Sanitize and validate inputs
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
    $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
    $credit = mysqli_real_escape_string($conn, $_POST['credit']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $schedule = mysqli_real_escape_string($conn, $_POST['schedule']);

    // Validate batch
    if($batch == "Select") {
        $errors[] = "Please select a valid batch";
    }

    // Validate credit
    if($credit == "Select" || !in_array($credit, ['1.0', '1.5', '2.0', '2.5', '3.0'])) {
        $errors[] = "Please select a valid credit";
    }

    // Check if course already exists
    $check_sql = "SELECT * FROM course_offer WHERE course_id = ? AND semester = ? AND batch = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("sss", $course_id, $semester, $batch);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $errors[] = "This course already exists for the selected batch and semester";
    }

    // If no errors, proceed with insertion
    if(empty($errors)) {
        $sql = "INSERT INTO course_offer (batch, semester, course_id, course_name, credit, schedule) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $batch, $semester, $course_id, $course_name, $credit, $schedule);
        
        if($stmt->execute()) {
            $conform_mgs = "Course added successfully";
            $_SESSION['batch_fatch_course'] = $batch;
        } else {
            $error_conform_mgs = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_conform_mgs = implode("<br>", $errors);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin_Home</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div id="header">
    <div class="admin_class">
      <a href="admin_logout.php" id="logout-link" onclick="return confirmLogout()">Logout</a>
    </div>
    <h1>Student portal</h1>
  </div>
  <div class="body_section">
    <div id="container" class="left_part">
        <div class="list_item_home_content">
          <label >Admin panel</label></br>
            <a href="admin_home.php" class="list_item_home">Home</a>
            <a href="add_course.php" class="list_item_home">Add Course</a>
            <a href="admin_conform.php" class="list_item_home">Verify Student</a>
            <a href="admin_reset_pass.php" class="list_item_home">Change Password</a>
        </div>
    </div>
    <div id="container" class="right_part ">
        <div id="welcome-message">
        <div id="container" class="course_right_part">
          <h3 style="padding:10px;margin-bottom:10px;border-bottom:2px solid rgb(17, 143, 143);color:rgb(17, 143, 143);"> Add Course</h3>
          <?php if(isset($_POST['submit'])): ?>
            <?php if(!empty($conform_mgs)): ?>
              <div class="alert-success" style="
                background-color: #d4edda;
                border-color: #c3e6cb;
                color: #155724;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid transparent;
                border-radius: 4px;
                text-align: center;
                font-weight: bold;
              ">
                <i class="fas fa-check-circle" style="margin-right: 10px;"></i>
                <?php echo $conform_mgs; ?>
              </div>
            <?php endif; ?>
            <?php if(!empty($error_conform_mgs)): ?>
              <div class="alert-danger" style="
                background-color: #f8d7da;
                border-color: #f5c6cb;
                color: #721c24;
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid transparent;
                border-radius: 4px;
                text-align: center;
                font-weight: bold;
              ">
                <i class="fas fa-exclamation-circle" style="margin-right: 10px;"></i>
                <?php echo $error_conform_mgs; ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>
          <form action="add_course.php" method="POST">
            <div  id="pro_border" class="profile_sec_1">
              <div class="course_box_middle">
                <label id="course_label"  for="batch_id">Batch ID </label>
                <select id="course_box" name="batch">
                  <option value="Select">Select Batch </option>
                  <option value="201">201</option>
                  <option value="202">202</option>
                  <option value="203">203</option>
                  <option value="211">211</option>
                  <option value="212">212</option>
                  <option value="213">213</option>
                  <option value="221">221</option>
                  <option value="222">222</option>
                  <option value="223">223</option>
                  <option value="231">231</option>
                  <option value="232">232</option>
                  <option value="233">233</option>
                  <option value="241">241</option>
                  <option value="242">242</option>
      
                </select>
                <label id="course_label"  for="batch_id">Course ID </label>
                <input id="course_box" type="text" name="course_id" placeholder="Course ID" required>
                <label id="course_label"  for="batch_id">Course Name </label>
                <input id="course_box" type="text" name="course_name" placeholder="Course Name" required>
                <label id="course_label"  for="batch_id">Semester </label>
                <select id="course_box" name="semester">
                  <option value="Spring_20">Spring_20</option>
                  <option value="Fall_20">Fall_20</option>
                  <option value="Summer_21">Summer_21</option>
                  <option value="Spring_21">Spring_21</option>
                  <option value="Fall_21">Fall_21</option>
                  <option value="Summer_22">Summer_22</option>
                  <option value="Spring_22">Spring_22</option>
                  <option value="Fall_22">Fall_22</option>
                  <option value="Summer_23">Summer_23</option>
                  <option value="Spring_23">Spring_23</option>
                  <option value="Fall_23">Fall_23</option>
                  <option value="Spring_24">Spring_24</option>
                  <option value="Fall_24">Fall_24</option>
                </select>
                <label id="course_label"  for="batch_id">Credit </label>
                <select id="course_box" name="credit">
                  <option value="Select"> Select Credit </option>
                  <option value="1.0">1</option>
                  <option value="1.5">1.5</option>
                  <option value="2.0">2</option>
                  <option value="2.5">2.5</option>
                  <option value="3.0">3</option>
                </select>
                <label id="course_label"  for="batch_id">Class Schedule </label>
                <select id="course_box" name="schedule">
                  <option value="select">Select Schedule</option>
                  <option value="Fri(08:00 AM - 09:30 AM) Sat(12:00 PM - 01:30 PM)">Fri(08:00 AM - 09:30 AM) Sat(12:00 PM - 01:30 PM)</option>
                  <option value="Fri(09:30 AM - 11:00 AM) Sat(08:00 AM - 09:30 AM)">Fri(09:30 AM - 11:00 AM) Sat(08:00 AM - 09:30 AM)</option>
                  <option value="Fri(02:00 PM - 03:30 PM) Sat(01:30 PM - 03:30 PM)">Fri(02:00 PM - 03:30 PM) Sat(01:30 PM - 03:30 PM)</option>
                  <option value="Mon(08:00 AM - 09:30 AM) Wed(12:00 PM - 01:30 PM)">Mon(08:00 AM - 09:30 AM) Wed(12:00 PM - 01:30 PM)</option>
                  <option value="Mon(09:30 AM - 11:00 AM) Wed(08:00 AM - 09:30 AM)">Mon(09:30 AM - 11:00 AM) Wed(08:00 AM - 09:30 AM)</option>
                  <option value="Mon(02:00 PM - 03:30 PM) Wed(01:30 PM - 03:30 PM)">Mon(02:00 PM - 03:30 PM) Wed(01:30 PM - 03:30 PM)</option>
                  <option value="Tue(08:00 AM - 09:30 AM) Thu(12:00 PM - 01:30 PM)">Tue(08:00 AM - 09:30 AM) Thu(12:00 PM - 01:30 PM)</option>
                  <option value="Tue(09:30 AM - 11:00 AM) Thu(08:00 AM - 09:30 AM)">Tue(09:30 AM - 11:00 AM) Thu(08:00 AM - 09:30 AM)</option>
                  <option value="Tue(02:00 PM - 03:30 PM) Thu(01:30 PM - 03:30 PM)">Tue(02:00 PM - 03:30 PM) Thu(01:30 PM - 03:30 PM)</option>
                  <option value="Mon(03:30 PM - 05:00 PM) Wed(03:30 PM - 05:00 PM)">Mon(03:30 PM - 05:00 PM) Wed(03:30 PM - 05:00 PM)</option>
                  <option value="Sat(03:30 PM - 05:00 PM) Tue(03:30 PM - 05:00 PM)">Sat(03:30 PM - 05:00 PM) Tue(03:30 PM - 05:00 PM)</option>
                  <option value="Thu(03:30 PM - 05:00 PM) Fri(03:30 PM - 05:00 PM)">Thu(03:30 PM - 05:00 PM) Fri(03:30 PM - 05:00 PM)</option>
                </select>
                <input style=" display:block;margin: 30px auto;" type="submit" id="submit_shadow" name="submit" value="Add Course">
              </div>
            </div>
          </form>
       </div>
          </div>
    </div>
  </div>
          <?php
  include("footer.php");
  ?>
</body>
</html>