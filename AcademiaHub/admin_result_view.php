<?php
session_start();
$fatch = $_SESSION['student_log']['student_id'];
include('conn.php');
if(empty($_SESSION['student_log']))
{
  header('location:student_logadmin.php');
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Result</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div id="header">
    <div class="admin_class"><a href="student_logout.php">Logout</a></div>
    <h1>Student Portal</h1>
  </div>

  <div class="body_section">
    <div id="container" class="left_part">
        <div class="list_item_home_content">
        <label>Teacher panel</label></br>
            <a href="teacher_home.php" class="list_item_home">Home</a>
            <a href="insert_result_home.php" class="list_item_home">Insert Result</a>
            <a href="search.php" class="list_item_home">Result view</a>
            <a href="attend_home.php" class="list_item_home">Attendance</a>
            <a href="teacher_reset_pass.php" class="list_item_home">Change Password</a>
        </div>
    </div>
    <div id="container" class="right_part">
        <div id="welcome-message">
        <div id="container">
          <h3 style="padding:10px;border-bottom:2px solid rgb(17, 143, 143);color:rgb(17, 143, 143);">Student Result View</h3>
         
          <div id="search_box">
              <form method="GET" action="" style="margin-bottom: 20px;">
                  <label for="student_id">Student ID :</label>
                  <input type="text" name="student_id" id="course_box" value="<?php echo isset($_GET['student_id']) ? htmlspecialchars($_GET['student_id']) : ''; ?>" required>
                  <input type="submit" value="Search" class="submit_shadow">
              </form>
          </div>
            <div  id="pro_border" class="profile_sec_1">
                  <div id="search_box_middle">
             
                      <table>
                          <tr>
                            <th style="padding:10px 15px;background-color:#a00e0ea1;"> Semester </th>
                            <th style="padding:10px 15px;background-color:#3a558ea1;"> Course ID </th>
                            <th style="padding:10px 15px;background-color:#45a049a1;"> Course Name </th>
                            <th style="padding:10px 15px;background-color:#a00e0ea1;"> Credit </th>
                            <th style="padding:10px 15px;background-color:#49a049a1;"> Marks </th>
                            <th style="padding:10px 15px;background-color:#3a558ea1;"> Grade </th>
                            <th style="padding:10px 15px;background-color:#45a049a1;"> GPA </th>
                          </tr>
                        <?php 
                        
                            if(isset($_GET['student_id'])) {
                                $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);
                                
                                $sql_join = "SELECT r.*, ct.course_name, ct.credit, ct.semester 
                                            FROM result r 
                                            INNER JOIN course_taken ct ON r.course_id = ct.course_id 
                                            WHERE r.student_id = ?
                                            ORDER BY ct.semester ASC";
                                            
                                $stmt = $conn->prepare($sql_join);
                                $stmt->bind_param("s", $student_id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                
                                if($result->num_rows > 0){
                                    while($show = $result->fetch_assoc()){
                                        $batch = $show['semester'];
                                        $course_id = $show['course_id'];
                                        $course_name = $show['course_name'];
                                        $credit = $show['credit'];
                                        $marks = $show['marks'];
                                        $grade = $show['grade'];
                                        $point = $show['points'];
                                
                          ?>
                          <tr>
                            <td style="padding:10px 15px;background-color:#f1f1f1;"><?php echo $batch?></td>
                            <td style="padding:10px 15px;background-color:#f1f1f1;"><?php echo $course_id?></td>
                            <td style="padding:10px 15px;background-color:#f1f1f1;"><?php echo $course_name?></td>
                            <td style="padding:10px 15px;background-color:#f1f1f1;"><?php echo $credit?></td>
                            <td style="padding:10px 15px;background-color:#f1f1f1;"><?php echo $marks?></td>
                            <td style="padding:10px 15px;background-color:#f1f1f1;"><?php echo $grade?></td>
                            <td style="padding:10px 15px;background-color:#f1f1f1;"><?php echo $point?></td>
                          </tr>
                          <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='7' style='text-align:center; padding:10px;'>No results found for this student.</td></tr>";
                                }
                            }
                          ?> 
                      </table>
                      <?php if(isset($_GET['student_id'])): ?>
                          <div style="margin-top: 20px;">
                              <?php
                              // Calculate CGPA
                              if(isset($result) && $result->num_rows > 0) {
                                  $total_points = 0;
                                  $total_credits = 0;
                                  
                                  $stmt->execute();
                                  $result = $stmt->get_result();
                                  
                                  while($row = $result->fetch_assoc()) {
                                      $total_points += ($row['points'] * $row['credit']);
                                      $total_credits += $row['credit'];
                                  }
                                  
                                  $cgpa = $total_credits > 0 ? round($total_points / $total_credits, 2) : 0;
                                  echo "<p style='text-align:right; font-weight:bold; color:#45a049;'>CGPA: " . number_format($cgpa, 2) . "</p>";
                              }
                              ?>
                          </div>
                      <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
  </div>
  
  <?php
  include("footer.php");
  ?>
</body>
</html>