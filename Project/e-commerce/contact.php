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
        // Assume successful login
        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $user['lpa_user_username'];  // Assuming $user is the authenticated user data
        $_SESSION['user_id'] = $user['lpa_user_id'];  // Assuming you set the user ID here during login
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Page</title>
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
                <!--<li style="position:absolute; right: 10px;"><a href="log_in.html">Log in</a></li>
                <li style="position:absolute; right: 150px;"><a href="cart.html">Cart</a></li>-->
            </ul>
        </nav>
    
    <!--picture-->>
    <div class="header">
        <h2>Contact</h2>
    </div>
    <!-- Main Content Area -->
    <main>
        
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Logic Peripherals Australia.</p>
    </footer>
</body>
</html>