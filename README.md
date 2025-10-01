# AcademiaHub

AcademiaHub is a comprehensive university portal system developed to streamline academic operations and enhance communication between students, faculty, and administrators. This web-based platform provides an integrated solution for managing academic activities, course registrations, and administrative tasks.

## 🌟 Features

### For Students
- Course registration and management
- View academic calendar and class routines
- Access academic results
- Track attendance
- View faculty profiles
- Online fee payment information

### For Faculty
- Manage course materials
- Record student attendance
- Input and manage grades
- View teaching schedule
- Profile management

### For Administrators
- Student enrollment management
- Course scheduling
- Faculty management
- Academic calendar management
- System-wide announcements

## 🚀 Quick Start

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- XAMPP/WAMP/MAMP server
- Web browser (Chrome, Firefox, Safari, etc.)

### Installation Steps

1. Clone the repository:
```bash
git clone https://github.com/Nuruzzaman-Nuru/AcademiaHub.git
```

2. Move the project to your web server directory:
- For XAMPP: `xampp/htdocs/`
- For WAMP: `wamp/www/`
- For MAMP: `mamp/htdocs/`

3. Import the database:
- Open phpMyAdmin
- Create a new database named 'portal'
- Import the SQL file from `sql/portal.sql`

4. Configure the database connection:
- Open `conn.php`
- Update the database credentials if needed

5. Access the portal:
```
http://localhost/AcademiaHub
```

## 📂 Project Structure

```
AcademiaHub/
├── css/                  # Stylesheets
├── includes/            # PHP includes
├── logo/               # Images and logos
├── sql/                # Database files
└── various .php files  # Core functionality
```

## 🔐 Login Information

### Admin Login
- URL: `/admin_log.php`
- Default credentials in database

### Faculty Login
- URL: `/teacher_log.php`
- Credentials provided by admin

### Student Login
- URL: `/student_log.php`
- Registration available via signup

## 🛠️ Technology Stack

- Frontend: HTML5, CSS3, JavaScript
- Backend: PHP
- Database: MySQL
- Additional: Font Awesome, Custom CSS Animations

## 📱 Responsive Design

The portal is fully responsive and optimized for:
- Desktop computers
- Tablets
- Mobile devices

## 🔄 Key Pages

- `index.php` - Homepage with news and announcements
- `faculty.php` - Faculty member profiles
- `departments.php` - Academic departments
- `academic_calendar.php` - Academic schedule
- `class_routine.php` - Class schedules
- And many more...

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under standard copyright laws. All rights reserved.

## ✨ Credits

Developed by: Nuruzzaman
Student ID: 221902335

## 📞 Contact

For any queries or support, please contact:
- Email: [Your contact email]
- GitHub: [@Nuruzzaman-Nuru](https://github.com/Nuruzzaman-Nuru)

---

Last Updated: October 2, 2025