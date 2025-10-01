<?php
require_once('conn.php');
require_once('includes/portal_data.php');

// Initialize variables
$totalStudents = 0;
$totalCourses = 102;
$activeUsers = rand(100, 500);

// Get total students from DB
$sql = "SELECT COUNT(*) as total FROM student_info";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $totalStudents = $row['total'];
}

// Default news if table doesn't exist
$latestNews = [
    ['title'=>'New Honorary Professor','description'=>'Professor Dr. Muhammad Shahriar Haque has joined as an Honorary Professor in the Department of English.','image_url'=>'logo/news1.jpg','link'=>'#'],
    ['title'=>'Foundation Day Celebration','description'=>'The university celebrated its Foundation Day with great enthusiasm.','image_url'=>'logo/news2.jpg','link'=>'#'],
    ['title'=>'Fall 2025 Admission','description'=>'Admission is going on for Fall 2025 semester in undergraduate and graduate programs.','image_url'=>'logo/news3.jpg','link'=>'student_signup.php']
];

// Default announcements if table doesn't exist
$announcements = [
    ['title'=>'Notice for All Students','content'=>'All students are hereby informed that class attendance has been made mandatory. Students having less than 60% attendance will not be allowed to sit for the final examination.','date'=>date('Y-m-d H:i:s'),'importance'=>'urgent'],
    ['title'=>'Fall 2025 Class Schedule','content'=>'The class schedule for Fall 2023 semester has been published. Students are requested to check their respective department notice boards.','date'=>date('Y-m-d H:i:s'),'importance'=>'important'],
    ['title'=>'Library Notice','content'=>'The central library will remain open from 9:00 AM to 9:00 PM during the examination period.','date'=>date('Y-m-d H:i:s'),'importance'=>'normal']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>University Portal</title>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/welcome.css">
<link rel="stylesheet" href="css/footer-fix.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<header>

<div style="display: flex; align-items: center; gap: 15px; margin: 20px;">

    <img src="logo/logo.png" alt="GUB Logo" style="width: 60px; height: auto;">

    <!-- Header ১ -->
    <h1 style="margin: 0; color: #008000; font-size: 28px;">AcademiaHub</h1>
</div>

<h2 style="text-align:center; margin:20px 0; color:#008000;">Welcome to AcademiaHub</h2>
<div>
<nav class="top-nav">
<ul class="nav-menu">
    <li class="nav-item">
        <a href="index.php" class="nav-link">Home</a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">About Us</a>
        <div class="dropdown-menu">
            <a href="about.php" class="dropdown-item">University Profile</a>
            <a href="mission.php" class="dropdown-item">Mission & Vision</a>
            <a href="history.php" class="dropdown-item">History</a>
        </div>
    </li>
    <li class="nav-item">
        <a href="admission.php" class="nav-link">Admission</a>
        <div class="dropdown-menu">
            <a href="student_signup.php" class="dropdown-item">New Registration</a>
            <a href="tuition.php" class="dropdown-item">Tuition & Fees</a>
        </div>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">Portal Login</a>
        <div class="dropdown-menu">
            <a href="admin_log.php" class="dropdown-item">Admin Login</a>
            <a href="teacher_log.php" class="dropdown-item">Teacher Login</a>
            <a href="student_log.php" class="dropdown-item">Student Login</a>
            <a href="student_signup.php" class="dropdown-item">Create Account</a>
        </div>
    </li>
    <li class="nav-item">
        <a href="academics.php" class="nav-link">Academics</a>
        <div class="dropdown-menu">
            <a href="departments.php" class="dropdown-item">Departments</a>
            <a href="class_routine.php" class="dropdown-item">Class Routine</a>
            <a href="academic_calendar.php" class="dropdown-item">Academic Calendar</a>
            <a href="faculty.php" class="dropdown-item">Faculty Members</a>
        </div>
    </li>
    <li class="nav-item">
        <a href="campus_life.php" class="nav-link">Campus Life</a>
        <div class="dropdown-menu">
            <a href="sports.php" class="dropdown-item">Sports</a>
            <a href="facilities.php" class="dropdown-item">Campus Facilities</a>
        </div>
    </li>
    <li class="nav-item">
        <a href="contact.php" class="nav-link">Contact</a>
        <div class="dropdown-menu">

            <a href="contact.php" class="dropdown-item">Contact Us</a>
        </div>
    </li>
</ul>
</nav>
</div>
</header>
<div class="slider">
  <div class="slide active" style="background-image:url('https://upload.wikimedia.org/wikipedia/commons/0/0e/Green_University_of_Bangladesh_campus_01.jpg')" title="GUB Campus View"></div>
  <div class="slide" style="background-image:url('https://upload.wikimedia.org/wikipedia/commons/4/44/A_Building%2C_City_campus%2C_Green_University_of_Bangladesh.jpg')" title="A Building, City Campus"></div>
  <div class="slide" style="background-image:url('https://siteadmin.green.edu.bd/uploads/images/news/2_1701970390_news-cover.jpg')" title="Main Building & Fountain"></div>
  <div class="slide" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Green_University_of_Bangladesh_campus_03.jpg/2560px-Green_University_of_Bangladesh_campus_03.jpg')" title="GUB Campus View"></div>
  <div class="slide" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/4/44/A_Building%2C_City_campus%2C_Green_University_of_Bangladesh.jpg')" title="A Building, City Campus"></div>
  <div class="slide" style="background-image: url('https://siteadmin.green.edu.bd/uploads/images/news/2_1701970390_news-cover.jpg')" title="Main Building & Fountain"></div>
  <!-- Navigation Buttons -->
  <button id="prevBtn" class="nav-btn">&#10094;</button>
  <button id="nextBtn" class="nav-btn">&#10095;</button>
</div>
<br>
<br>
<section class="stats-section">
    <div class="stats-container">
        <div class="stat-card">
            <i class="fas fa-user-graduate"></i>
            <div class="stat-number" id="studentCount">15,000+</div>
            <div class="stat-label">Total Students</div>
        </div>
        <div class="stat-card">
            <i class="fas fa-book"></i>
            <div class="stat-number">102</div>
            <div class="stat-label">Available Courses</div>
        </div>
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <div class="stat-number" id="activeCount">454</div>
            <div class="stat-label">Active Users</div>
        </div>
        <div class="stat-card">
            <i class="fas fa-chalkboard-teacher"></i>
            <div class="stat-number">164</div>
            <div class="stat-label">Faculty Members</div>
        </div>
    </div>
</section>
<br>
<!-- News Section -->
<div class="news-section" style="width:80%; margin:20px auto; background:rgba(255, 255, 255, 0.95); padding:20px; border-radius:15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
<h3 style="color:#008000; margin-bottom:15px; border-bottom:2px solid #008000; padding-bottom:10px;">Latest News</h3>
<?php foreach($latestNews as $news): ?>
<div style="margin-bottom:20px; padding-bottom:10px; border-bottom:1px solid #eee;">
<h4><?php echo htmlspecialchars($news['title']); ?></h4>
<p><?php echo htmlspecialchars($news['description']); ?></p>
<a href="<?php echo htmlspecialchars($news['link']); ?>" style="color:#008000; text-decoration:none;">Read More</a>
</div>
<?php endforeach; ?>
</div>

<!-- Announcements -->
<div class="announcements" style="width:80%; margin:20px auto; background:rgba(255, 255, 255, 0.95); padding:20px; border-radius:15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
<h3 style="color:#008000; margin-bottom:15px; border-bottom:2px solid #008000; padding-bottom:10px;"><i class="fas fa-bullhorn"></i> Live Announcements</h3>
<div id="dynamic-announcements"></div>
</div>

<!-- Quick Links -->
<div class="quick-links" style="width:80%; margin:20px auto; background:rgba(255, 255, 255, 0.95); padding:20px; border-radius:15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
<h3 style="color:#008000; margin-bottom:15px; border-bottom:2px solid #008000; padding-bottom:10px;">Important Links</h3>
<div style="display:flex; flex-wrap:wrap; gap:10px;">
<?php foreach($quickLinks as $link): ?>
<a href="<?php echo htmlspecialchars($link['url']); ?>" style="padding:10px 20px; background:#f5f5f5; text-decoration:none; color:#333; border-radius:5px;">
<?php echo htmlspecialchars($link['title']); ?>
</a>
<?php endforeach; ?>
</div>
</div>



<script>
const slides = document.querySelectorAll('.slide');
let currentIndex = 0;

// Show a specific slide
function showSlide(index) {
  slides.forEach(slide => slide.classList.remove('active'));
  slides[index].classList.add('active');
}

// Next button
document.getElementById('nextBtn').addEventListener('click', () => {
  currentIndex = (currentIndex + 1) % slides.length;
  showSlide(currentIndex);
});

// Previous button
document.getElementById('prevBtn').addEventListener('click', () => {
  currentIndex = (currentIndex - 1 + slides.length) % slides.length;
  showSlide(currentIndex);
});

// Auto slide every 4 seconds
setInterval(() => {
  currentIndex = (currentIndex + 1) % slides.length;
  showSlide(currentIndex);
}, 4000);

// Update announcements
const allAnnouncements = [
  {title:"Notice for All Students", content:"All students are hereby informed that class attendance has been made mandatory. Students having less than 60% attendance will not be allowed to sit for the final examination.", type:"important"},
  {title:"Fall 2025 Class Schedule", content:"The class schedule for Fall 2025 semester has been published. Students are requested to check their respective department notice boards.", type:"academic"},
  {title:"Library Notice", content:"The central library will remain open from 9:00 AM to 9:00 PM during the examination period.", type:"general"},
  {title:"Midterm Examination Schedule", content:"Midterm examinations will commence from September 15, 2025. Detailed schedule will be published soon.", type:"exam"},
  {title:"Campus Event", content:"Annual Cultural Festival will be held on October 1, 2025. All students are encouraged to participate.", type:"event"},
  {title:"Scholarship Announcement", content:"Applications are now open for Merit-based scholarships for Fall 2025. Last date to apply is September 30, 2025.", type:"important"},
  {title:"Workshop Notice", content:"A workshop on 'Professional Development' will be conducted on August 25, 2025 in the main auditorium.", type:"event"}
];

function getIconForType(type) {
  const icons = {important:'exclamation-circle', academic:'graduation-cap', general:'info-circle', exam:'clipboard-check', event:'calendar-alt'};
  return icons[type] || 'bell';
}

function updateAnnouncements() {
  const container = document.getElementById('dynamic-announcements');
  container.innerHTML = '';
  const shuffled = [...allAnnouncements].sort(() => 0.5 - Math.random());
  const selected = shuffled.slice(0,3);
  const currentDate = new Date();
  selected.forEach(announcement => {
    const div = document.createElement('div');
    div.className = 'announcement-item';
    div.innerHTML = `
      <div class="announcement-header">
        <i class="fas fa-${getIconForType(announcement.type)}"></i>
        <span class="announcement-date">${currentDate.toLocaleDateString('en-US', { day:'2-digit', month:'short', year:'numeric'})}</span>
      </div>
      <div class="announcement-content">
        <h4>${announcement.title}</h4>
        <p>${announcement.content}</p>
      </div>`;
    container.appendChild(div);
  });
}
updateAnnouncements();
setInterval(updateAnnouncements, 30000);

// Update stats with random animation
function updateStats() {
    const studentElement = document.getElementById('studentCount');
    const activeElement = document.getElementById('activeCount');
    studentElement.textContent = (<?php echo $totalStudents; ?> + Math.floor(Math.random()*50)).toLocaleString();
    activeElement.textContent = (100 + Math.floor(Math.random()*400)).toLocaleString();
}
setInterval(updateStats, 10000);
</script>
</main>
<?php include("footer.php"); ?>
<script>
// Ensure proper layout after page load
document.addEventListener('DOMContentLoaded', function() {
    // Force layout recalculation
    document.body.offsetHeight;
});

<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main {
    flex: 1 0 auto;
    display: flex;
    flex-direction: column;
}

.site-footer {
    flex-shrink: 0;
    width: 100%;
    margin: 0;
    padding: 40px 0;
    background-color: #2c3e50;
    color: white;
    bottom: 0;
}
</style>
</body>
</html>
