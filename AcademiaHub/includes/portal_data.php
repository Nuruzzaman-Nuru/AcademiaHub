<?php
// News & Events data
function getLatestNews() {
    global $conn;
    $news = array();
    
    // Check if table exists
    $checkTable = $conn->query("SHOW TABLES LIKE 'news_events'");
    if (!$checkTable || $checkTable->num_rows == 0) {
        return $news;
    }
    
    $sql = "SELECT * FROM news_events ORDER BY date DESC LIMIT 5";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
    }
    return $news;
}

// Announcements data
function getAnnouncements() {
    global $conn;
    $announcements = array();
    
    // Check if table exists
    $checkTable = $conn->query("SHOW TABLES LIKE 'announcements'");
    if (!$checkTable || $checkTable->num_rows == 0) {
        return $announcements;
    }
    
    $sql = "SELECT * FROM announcements ORDER BY date DESC LIMIT 5";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $announcements[] = $row;
        }
    }
    return $announcements;
}

// Quick Links data from green.edu.bd
$quickLinks = [
    [
        'title' => 'Academic Calendar',
        'icon' => 'calendar',
        'url' => 'https://green.edu.bd/academic-calendar/'
    ],
    [
        'title' => 'Admission',
        'icon' => 'user-graduate',
        'url' => 'https://green.edu.bd/admission/'
    ],
    [
        'title' => 'Result Portal',
        'icon' => 'clipboard-check',
        'url' => 'result.php'
    ],
    [
        'title' => 'Notice Board',
        'icon' => 'bullhorn',
        'url' => 'https://green.edu.bd/notice-board/'
    ],
    [
        'title' => 'Course Catalog',
        'icon' => 'book',
        'url' => 'https://green.edu.bd/academic/course-catalog/'
    ],
    [
        'title' => 'Library',
        'icon' => 'book-reader',
        'url' => 'https://green.edu.bd/facilities/library/'
    ]
];
?>
