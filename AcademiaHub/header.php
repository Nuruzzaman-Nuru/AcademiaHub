<?php
// Initialize any required includes
require_once('conn.php');
if (file_exists('includes/portal_data.php')) {
    require_once('includes/portal_data.php');
}

// Check if title is set, if not use default
if (!isset($pageTitle)) {
    $pageTitle = "AcademiaHub";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/welcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        font-family: Arial, sans-serif;
    }

    main {
        flex: 1 0 auto;
        display: flex;
        flex-direction: column;
    }

    .content-wrapper {
        flex: 1 0 auto;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    </style>
</head>
<body>
<main>
