<?php
try {
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=ranim', 'root', '');
  // Définir le mode d'erreur PDO à exception
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  // En cas d'erreur de connexion, afficher l'erreur
  die("Erreur : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Récupérer les valeurs saisies dans le formulaire
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Requête SQL pour insérer les données dans la base de données
  $query = $bdd->prepare("INSERT INTO contact (name, email, message) VALUES(:name, :email, :message)");

  // Liaison des paramètres
  $query->bindValue(':name', $name);
  $query->bindValue(':email', $email);
  $query->bindValue(':message', $message);

  // Exécution de la requête
  $query->execute();

  // Redirection vers une autre page après l'envoi du message
  header("Location: index.html");
  exit();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="icon" href="image/logo.png" type="image/x-icon">
    <script src="/javascript/javascript.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
    <title>CONTACT</title>
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
              <li class="item current"><a class="link" href="contact.php">CONTACT</a></li>
              <li class="item"><a class="link" href="signup.php">SIGN UP</a></li>
              <li class="item"><a class="link" href="login.php">LOGIN</a></li>
            </ul>
          </div>
    </nav>
    <main>
      <section class=" container contact">
        <div class="row icons-container">
            <div class="col-lg icons">
              <i class="fa fa-phone"></i>
                <h3>NUMBER</h3>
                <p>+216 71 252012</p>
                <p>+216 71 278418</p>
            </div>
            <div class="col-lg icons">
              <i class="fa fa-envelope"></i>
                <h3>EMAIL</h3>
                <p>tothetopfreelancer@gmail.com</p>
                <p>info@tothetopfreelancer.com</p>
            </div>
            <div class="col-lg icons">
              <i class="fa fa-map-marker"></i>
                <h3>LOCATION</h3>
                <p>Tunis, Tunisie</p>
               
            </div>
        </div>
    </section>
              <div class="container2">
                <div class="content">
                  <div class="image-box">
                   <img src="image/remote-team.png" alt="contact with to the top">
                  </div>
                  <form action="#" method="POST">
                    <div class="topic">GET IN TOUCH</div>
                       <p>“Opportunities present themselves, but it's up to freelancers to seize them and create their own success.”</p>
                     <div class="input-box">
                      <input style="border-radius: 1.4rem;" type="text" name="name" required>
                      <label style="border-radius: 0.5rem;">Enter your name</label>
                     </div>
                    <div class="input-box">
                     <input style="border-radius: 1.4rem;" type="text" name="email" required>
                      <label style="border-radius: 0.5rem;">Enter your email</label>
                     </div>
                   <div class="message-box">
                      <textarea style="border-radius: 1.4rem;" name="message" required></textarea>
                       <label style="border-radius: 0.5rem;">Enter your message</label>
                  </div>
                <div class="input-box">
                   <input style="border-radius: 1.5rem;" type="submit" value="Send Message">
                  </div>
                 </form>

              </div>
             
            </div>
    </main>
</body>
    <footer class="footer-distributed">

            <div class="footer-left">
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
                      <strong>To The Top FREELANCER</strong>we are committed to providing top-notch customer service, striving for excellence in every aspect of our work. We are dedicated to exceeding expectations, continuously seeking innovation, and executing the most demanding projects with diligence and professionalism!
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
</html>