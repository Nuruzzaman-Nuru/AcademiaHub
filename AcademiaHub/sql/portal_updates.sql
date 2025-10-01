-- Add these tables to your portal.sql

-- News & Events Table
CREATE TABLE IF NOT EXISTS news_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    type ENUM('news', 'event') NOT NULL,
    link VARCHAR(255)
);

-- Announcements Table
CREATE TABLE IF NOT EXISTS announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    importance ENUM('normal', 'important', 'urgent') DEFAULT 'normal'
);

-- Insert sample data for News & Events
INSERT INTO news_events (title, description, image_url, type, link) VALUES
('Fall 2025 Admission', 'Admission open for Fall 2025 semester. Apply now!', 'images/admission.jpg', 'news', 'admission.php'),
('Research Seminar', 'Latest research publications and academic achievements', 'images/research.jpg', 'event', 'research.php'),
('New Computer Lab', 'State-of-the-art computer lab opened', 'images/lab.jpg', 'news', 'facilities.php');

-- Insert sample data for Announcements
INSERT INTO announcements (title, content, importance) VALUES
('Fall 2025 Registration', 'Course registration for Fall 2025 starts from September 1, 2025', 'important'),
('Mid-term Exam Schedule', 'Mid-term examinations will start from October 15, 2025', 'urgent'),
('Library Notice', 'New digital library resources available for all departments', 'normal');
