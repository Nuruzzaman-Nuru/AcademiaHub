-- ============================
-- Admin Info Table
-- ============================
CREATE TABLE admin_info (
  id INT(11) NOT NULL AUTO_INCREMENT,
  emp_id INT(11) NOT NULL,
  name VARCHAR(30) NOT NULL,
  email VARCHAR(30) NOT NULL,
  admin_pass VARCHAR(12) NOT NULL,
  admin_depart VARCHAR(10) NOT NULL,
  admin_position VARCHAR(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Sample Data
INSERT INTO admin_info (emp_id, name, email, admin_pass, admin_depart, admin_position) VALUES
(1001, 'Nuruzzaman', 'admin@gmail.com', 'admin', 'CSE', 'Admin'),
(1002, 'Uttam', 'uttamcse@gmail.com', 'uttamcse', 'CSE', 'Teacher'),
(1003, 'Nurzaman', 'nurzamancse@gmail.com', 'nurucse', 'CSE', 'Teacher');


-- ============================
-- Attendance Table
-- ============================
CREATE TABLE attendance (
  id INT(11) NOT NULL AUTO_INCREMENT,
  student_id INT(11) NOT NULL,
  course_id VARCHAR(10) NOT NULL,
  p_date DATE NOT NULL,
  attendance ENUM('Present','Absent') DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ============================
-- Course Offer Table
-- ============================
CREATE TABLE course_offer (
  id INT(11) NOT NULL AUTO_INCREMENT,
  batch INT(11) NOT NULL,
  semester VARCHAR(15) NOT NULL,
  course_id VARCHAR(10) NOT NULL,
  course_name VARCHAR(30) NOT NULL,
  credit FLOAT NOT NULL,
  price INT(11) DEFAULT NULL,
  schedule VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Trigger for auto price calculation
DELIMITER $$
CREATE TRIGGER ADD_price 
BEFORE INSERT ON course_offer 
FOR EACH ROW 
BEGIN
  IF NEW.credit = 1 THEN
    SET NEW.price = 2800;
  ELSEIF NEW.credit = 1.5 THEN
    SET NEW.price = 3500;
  ELSEIF NEW.credit = 2 THEN
    SET NEW.price = 3000;
  ELSEIF NEW.credit = 2.5 THEN
    SET NEW.price = 3500;
  ELSEIF NEW.credit = 3 THEN
    SET NEW.price = 4000;
  ELSEIF NEW.credit = 4 THEN
    SET NEW.price = 4200;
  END IF;
END$$
DELIMITER ;


-- ============================
-- Course Taken Table
-- ============================
CREATE TABLE course_taken (
  id INT(11) NOT NULL AUTO_INCREMENT,
  student_id INT(11) NOT NULL,
  semester VARCHAR(15) NOT NULL,
  course_id VARCHAR(10) NOT NULL,
  course_name VARCHAR(50) NOT NULL,
  credit FLOAT NOT NULL,
  price INT(11) DEFAULT NULL,
  schedule VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ============================
-- Result Table
-- ============================
CREATE TABLE result (
  id INT(11) NOT NULL AUTO_INCREMENT,
  student_id INT(11) NOT NULL,
  course_id VARCHAR(15) NOT NULL,
  batch INT(11) NOT NULL,
  section VARCHAR(5) NOT NULL,
  semester VARCHAR(15) NOT NULL,
  marks INT(11) NOT NULL,
  grade VARCHAR(5) NOT NULL,
  points FLOAT NOT NULL,
  course_name VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- ============================
-- Student Info Table
-- ============================
CREATE TABLE student_info (
  student_id INT(11) NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(15) NOT NULL,
  last_name VARCHAR(10) NOT NULL,
  depart_name VARCHAR(10) NOT NULL,
  batch INT(11) NOT NULL,
  section VARCHAR(12) NOT NULL,
  semester VARCHAR(8) NOT NULL,
  email VARCHAR(30) NOT NULL,
  pass VARCHAR(12) NOT NULL,
  dob DATE NOT NULL,
  nation VARCHAR(15) NOT NULL,
  mobile VARCHAR(14) NOT NULL,
  gender VARCHAR(6) NOT NULL,
  religion VARCHAR(10) NOT NULL,
  blood VARCHAR(3) NOT NULL,
  marit VARCHAR(10) NOT NULL,
  father_n VARCHAR(20) NOT NULL,
  father_pro VARCHAR(20) NOT NULL,
  mother_n VARCHAR(20) NOT NULL,
  mother_pro VARCHAR(20) NOT NULL,
  gurdian_n VARCHAR(20) NOT NULL,
  gurdian_phone VARCHAR(14) NOT NULL,
  present_add VARCHAR(255) NOT NULL,
  permanent_add VARCHAR(255) NOT NULL,
  PRIMARY KEY (student_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

