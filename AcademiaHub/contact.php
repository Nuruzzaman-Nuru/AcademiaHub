<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/new-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <main>
        <div class="contact-container">
        <h3 class="contact-title">Contact Us</h3>
        <div class="contact-info">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-whatsapp me-2"></i>
            <div>
              <div>WhatsApp</div>
              <a href="https://wa.me/qr/MFMZ6KRSOVLMF1" class="text-white text-decoration-none">0130734764</a>
            </div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-telephone me-2"></i>
            <div>
              <div>Call Us</div>
              <a href="tel:01307347646" class="text-white text-decoration-none">01307347646</a>
            </div>
          </div>
          <div class="d-flex align-items-center mb-3">
  <i class="bi bi-envelope me-2"></i>
  <div>
    <div>Email</div>
    <a href="mailto:contact@university.edu" class="text-white text-decoration-none">contact@university.edu</a>
    </div>
  </div>
            </div>
        </div>
    </main>
    
    <?php
    define('FOOTER_CSS_INCLUDED', true);
    include("footer.php");
    ?>
</body>
</html>