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
    <title>Product Page</title>
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
    
    <!-- Search Section -->
    <section id="search-section">
        <input type="text" id="search-input" placeholder="Search products..." onkeyup="filterProducts()">
    </section>

    <!-- Page Body (Product Listings) -->
    <!--<section id="product-listing">-->
    <!-- Sample Products -->
    <main>
        <div class="include_product">
            <?php
                // Include the database connection
                include('config.php');

                // Fetch the products from the database
                $sql = "SELECT * FROM lpa_stock";  // Adjust this query to match your table and columns
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output each product
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="product" data-product-id="' . $row["lpa_stock_ID"] . '">
                                <h2 class="product-name">' . $row["lpa_stock_name"] . '</h2>
                                <img src="' . $row["lpa_stock_picture"] . '" width="200" height="200">
                                <p class="product-description">' . $row["lpa_stock_desc"] . '</p>
                                <p class="product-quantity">Quantity: ' . $row["lpa_stock_onhand"] . '</p>
                                <p class="product-price">$' . $row["lpa_stock_price"] . '</p>
                                <button class="add-to-cart" onclick="addToCart(\'' . $row["lpa_stock_ID"] . '\', \'' . $row["lpa_stock_name"] . '\', ' . $row["lpa_stock_price"] . ', ' . $row["lpa_stock_onhand"] . ')">Add to Cart</button>
                            </div>';
                    }
                } else {
                    echo "0 results found";
                }
                $conn->close();
            ?>       
        </div>
    </main>
    
    <!--</section>-->
    <!-- Page Footer -->
    <footer>
        <p>&copy; 2024 Logic Peripherals Australia.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
