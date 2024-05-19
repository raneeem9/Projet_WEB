<?php
session_start(); // Start the session
$bdd = new PDO('mysql:host=127.0.0.1;dbname=client', 'root', '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (isset($_POST['email'], $_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Query to check login information
            $query = $bdd->prepare("SELECT * FROM client WHERE email = ? AND password1 = ?");
            $query->execute(array($email, $password));
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // User found, save login information in session
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_type'] = $user['user_type'];

                // Redirect based on user type
                if ($user['user_type'] == 'client') {
                    header('Location: find_talent.php');
                    exit; // Stop script execution after redirection
                } elseif ($user['user_type'] == 'freelancer') {
                    // Check if the freelancer has already submitted information
                    $query = $bdd->prepare("SELECT * FROM freelancer WHERE email = ?");
                    $query->execute([$user['email']]);
                    $freelancer = $query->fetch(PDO::FETCH_ASSOC);

                    if ($freelancer) {
                        header("Location: display_information.php");
                        exit();
                    } else {
                        header("Location: profil.php");
                        exit();
                    }
                } else {
                    echo "Unknown user type.";
                }
            } else {
                // Inform the user that login information is incorrect
                echo "Email or password incorrect.";
            }
        } else {
            echo "One or more POST parameters are missing.";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="image/logo.png" type="image/x-icon">
    <script src="/javascript/javascript.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <title>Login</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="imageBox">
            <div class="imageInn">
                <a href="index.html">
                    <img src="image/freelance.png" style="margin-left: 1rem; width: 100px; height: auto;" class="logo">
                  </a>
                  
            </div>
           
        </div>
          
        <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#nav" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bg-light"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="nav">
            <ul class="navbar-nav">
                <li class="item"><a class="link" href="index.html">HOME</a></li>
                <li class="item"><a class="link" href="categories/index.php">CATEGORIES</a></li>
                <li class="item"><a class="link" href="freelancer.php">FREELANCER</a></li>
                <li class="item"><a class="link" href="about.html">ABOUT</a></li>
                <li class="item"><a class="link" href="contact.php">CONTACT</a></li>
                <li class="item current"><a class="link" href="login.php">LOGIN</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container main">
            <h2>Login</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </main>
    <footer class="footer-distributed">
        <div class="footer-left">
            <a href="index.html">
            <a href="index.html"><img src="image/freelance.png" style="margin-left: 2rem; width: 150px; height: auto;"></a>
            <p class="footer-links">
                <a href="index.html">HOME</a>
                |
                <a href="categories.php">CATEGORIES</a>
                |
                <a href="freelancer.php">FREELANCER</a>
                |
                <a href="about.html">ABOUT</a>
                |
                <a href="contact.php">CONTACT</a>
                |
                <a href="signup.php">SIGN UP</a>
                |
                    <a href="login.php">LOGIN</a>
            </p>
            <p class="footer-company-name">Copyright © 2024 <strong>ToTheTopFREELANCER</strong> All rights reserved</p>
        </div>
    
        <div class="footer-center">
            <div class="center-link">
                <a href="#"><i class="fa fa-map-marker"></i></a>
                <p><span>Tunis</span>
                    Tunisie</p>
            </div>
    
            <div class="center-link">
                <a href="tel:+95975125012"><i class="fa fa-phone"></i></a>
                <p>(+216) 9751252012 </p>
            </div>
            <div class="center-link">
                <a href="mailto:tothetopfreelancer@gmail.com"><i class="fa fa-envelope"></i></a>
                <p><a href="mailto:tothetopfreelancer@gmail.com">tothetopfreelancer@gmail.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the company</span>
                <strong>To The Top FREELANCER</strong> - we are committed to providing top-notch customer service, striving for excellence in every aspect of our work. We are dedicated to exceeding expectations, continuously seeking innovation, and executing the most demanding projects with diligence and professionalism!
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
               
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
