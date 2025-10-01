<?php
// Check if the CSS files have been included
if (!defined('FOOTER_CSS_INCLUDED')) {
    echo '<link rel="stylesheet" href="css/new-footer.css">';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">';
    define('FOOTER_CSS_INCLUDED', true);
}
?>

<footer class="site-footer">
    <div class="footer-content">
        <!-- Find Us Section -->
        <div class="footer-section">
            <h3>Find Us</h3>
            <p>Purbachal American City, Kanchan, Rupganj, Narayanganj<br>
               Address Line 2,<br>
               Mirpur 12, Dhaka, Bangladesh</p>
            <p>+1234567890</p>
            <p>Secondary Contact:<br>
               01307347646</p>
            <p>contact@university.edu</p>
        </div>

        <!-- Departmental Sites Section -->
        <div class="footer-section">
            <h3>Departmental Sites</h3>
            <ul>
                <li><a href="#">Business Administration</a></li>
                <li><a href="#">Computer Science And Engineering</a></li>
                <li><a href="#">Software Engineering</a></li>
                <li><a href="#">English</a></li>
                <li><a href="#">Law</a></li>
            </ul>
        </div>

        <!-- Useful Links Section -->
        <div class="footer-section">
            <h3>Useful Links</h3>
            <ul>
                <li><a href="#">Convocation</a></li>
                <li><a href="#">Photo Gallery</a></li>
                <li><a href="#">Campus Map</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Forms</a></li>
            </ul>
        </div>

        <!-- Follow Us Section -->
        <div class="footer-section">
            <h3>Follow Us</h3>
            <div class="social-links">
                <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <!-- Scroll / Home Button -->
<a href="index.php" class="back-to-home">
<i class="fas fa-home"></i>
</a>

    
    <!-- Copyright Section -->
    <div class="copyright">
        <p>&copy; 2024-2025 University Portal. All Rights Reserved.</p>
        <p>Developed By <a href="https://nurzamanportfolio.vercel.app/" class="developer-link">Nuruzzaman</a></p>
    </div>
</footer>