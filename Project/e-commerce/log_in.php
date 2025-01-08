<?php
    session_start();
    include('config.php'); // Include your DB connection file

    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // Prepare SQL query to prevent SQL injection
        $sql = "SELECT * FROM lpa_users WHERE lpa_user_username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username); // "s" means string

        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        // Check if user exists and verify password
        if ($user) {
            if (password_verify($password, $user['lpa_user_password'])) {
                // Password is correct, start session
                $_SESSION['loggedIn'] = true;
                $_SESSION['user_id'] = $user['lpa_user_ID'];
                $_SESSION['first_name'] = $user['lpa_user_firstname'];
                $_SESSION['last_name'] = $user['lpa_user_lastname'];
                $_SESSION['address'] = $user['lpa_user_group'];
                $_SESSION['username'] = $user['lpa_user_username'];
                $_SESSION['success_message'] = 'Welcome to system.';
                header("Location: product.php");
                exit(); // Ensure no further code is executed after redirection
            } else {
                $_SESSION['error_message'] = 'Invalid password.';
            }
        } else {
            $_SESSION['error_message'] = 'No user found with that username.';
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-in Page</title>
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="747954-Product-1-I-638567925047048852.webp">
        <!-- Link to your CSS file -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>

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

    <!-- Display session messages (if any) -->
    <?php
        // Check and display any session messages
        if (isset($_SESSION['error_message'])) {
            echo "<div class='alert error'>{$_SESSION['error_message']}</div>";
            unset($_SESSION['error_message']);
        }

        if (isset($_SESSION['success_message'])) {
            echo "<div class='alert success'>{$_SESSION['success_message']}</div>";
            unset($_SESSION['success_message']);
        }
    ?>
    
    <div class="login">
        <div class="dialog">
            <h2>Customer Login</h2>
            <form action="log_in.php" method="POST"> <!-- Ensure this is the correct path -->
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <button type="submit" name="submit">Login</button>
                </div>
                <div class="input-group">
                    <button type="button" class="register-button" onclick="location.href='register.php'">Register</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Logic Peripherals Australia.</p>
    </footer>
</body>
</html>