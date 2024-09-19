<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawyer Management System</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
     body {
            background-image: url('images/background.jpg');
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Do not repeat the background image */
            height: 100vh; /* Ensure full viewport height */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }
    </style>
<body>
    <div class="marquee-container">
        <marquee behavior="scroll" direction="right">
            <h1>Find Your Suitable Lawyer Here</h1>
        </marquee>
    </div>
    <header>
        <nav>
            <ul class="left-nav">
                <li><a href="index.php">LEGALEASE</a></li>
            </ul>
            <ul class="right-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="lawyers.php">Lawyers</a></li>
                <li><a href="login.php">Login</a></li>
                <li class="dropdown">
                    <a href="#">Register &#9662;</a>
                    <div class="dropdown-content">
                        <a href="user_register.php">Register as a User</a>
                        <a href="lawyer_register.php">Register as a Lawyer</a>
                    </div>
                </li>
                <li><a href="#">About Us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="features">
            <div class="container">
                <div class="feature">
                    <h3>WELCOME</h3>
                    <p>Welcome to LEGALEASE. For Lawyers and Clients to connect.</p>
                </div>
            </div>
        </section>

        <section id="cta">
            <div class="container">
                <h1>About US</h1>
                <p>Welcome to the LEGALEASE, your trusted platform for finding the right legal representation tailored to your needs. Our mission is to connect individuals with qualified lawyers who specialize in various fields of law, ensuring you receive the best legal advice and support.</p>
                <h2>Our Contact details</h2>
                <h4>Address - roserotash@gmail.com</h4>
                <h4>Contact no. - +254791318073</h4>
                <button>Contact Us</button>
                <h6><b>Mission</b></h6>
                <p>Our mission is to connect individuals with qualified lawyers who specialize in various fields of law, ensuring that you receive the best legal advice and support tailored to your needs.</p>
                <h7><b>Vision</b></h7>
                <p>We envision a world where accessing legal representation is seamless and efficient, empowering individuals to find the right legal support with ease and confidence, and fostering a more informed and just society</p>
            </div>
        </section>
    </main>

    <footer>
        <div class="customnav">
            <p>&copy; 2024 LegalEase. All rights reserved.</p>
        </div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
