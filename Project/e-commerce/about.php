<?php
    session_start();

    // Set default values for session variables if not set
    if (!isset($_SESSION['loggedIn'])) {
        $_SESSION['loggedIn'] = false; // Default to not logged in
    }

    if (!isset($_SESSION['username'])) {
        $_SESSION['username'] = ''; // Default to empty username
    }

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] = ''; // Default to empty user ID if not set
    }

    // Simulate login process (you can replace this with real authentication logic)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Assuming the login is successful (replace this with actual authentication logic)
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = htmlspecialchars($_POST['username']);  // Sanitize input
        $_SESSION['user_id'] = 1;  // Example user ID
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About Page</title>
        <!--Favicon-->
        <link rel="icon" type="image/x-icon" href="747954-Product-1-I-638567925047048852.webp">
        <!-- Link to your CSS file -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <!-- Header -->
        <header>
            <h1>Logic Peripherals Australia (LPA)</h1>
        </header>
        <!-- Link the external JavaScript file -->
        <script src="script.js"></script>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>  
                <li><a href="product.php">Product</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php" class="cart">(0)</a></li>
                <li><a href="<?php echo isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ? 'log_out.php' : 'log_in.php'; ?>">
                    <?php echo isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] ? 'Hi ' . htmlspecialchars($_SESSION['username']) . ', ' . 'Log Out' : 'Log In'; ?>
                </a></li>
            </ul>
        </nav>
    <!--picture-->>
    <div class="header">
        <h2>About</h2>
    </div>
    
    <!-- Main Content Area -->
    <main>
        <!-- Mission Statement Section -->
        <section id="mission-statement">
            <h2>Our Mission</h2>
            <p>At Logical Peripherals Australia, our mission is to provide cutting-edge technology solutions that enhance the everyday lives of our customers. We strive for excellence in innovation, customer service, and product quality.</p>
        </section>

        <!-- YouTube Video Embed Section -->
        <section id="youtube-video">
            <h2>Watch Our Introduction</h2>
            <div class="video-container">
                <!-- YouTube Embed Code -->
                <iframe width="560" height="315" src="https://www.youtube.com/embed/M0F4cc2dkV8?si=p-P2RxOt4GfeJIWf" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
        </section>

        <!-- Facebook Feed Section -->
        <section id="facebook-feed">
            <h2>Follow Us on Facebook</h2>
            <div class="fb-page" data-href="https://www.facebook.com/JBHiFi/" data-tabs="timeline" data-width="500" data-height="600" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/JBHiFi/" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/JBHiFi/">Logical Peripherals Australia</a>
                </blockquote>
            </div>
        </section>

        <!-- Google Map Section -->
        <section id="google-map">
            <h2>Our Head Office Location</h2>
            <div class="map-container">
                <!-- Google Map Embed Code -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.1252277328813!2d153.0265859762565!3d-27.465360476322125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b915a1d772edb2d%3A0xa10d73f1dee93c97!2sCanterbury%20Technical%20Institute!5e0!3m2!1sen!2sau!4v1731040597896!5m2!1sen!2sau" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Logic Peripherals Australia.</p>
    </footer>
</body>
</html>
