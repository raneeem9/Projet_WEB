<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=client','root','');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jobTitle = $_POST['jobTitle'];
    $category = $_POST['category'];
    $jobDescription = $_POST['jobDescription'];
    $skillsRequired = $_POST['skillsRequired'];
    $budget = $_POST['budget'];
    $deadline = $_POST['deadline'];

    // Vérifier si la catégorie saisie existe dans la base de données
    $checkCategory = $bdd->prepare("SELECT * FROM Categories WHERE categoryName = ?");
    $checkCategory->execute([$category]);
    $categoryExists = $checkCategory->rowCount();

    if ($categoryExists) {
        // La catégorie existe, donc nous pouvons insérer l'emploi avec cette catégorie
        $insertion = $bdd->prepare("INSERT INTO Job_Info (jobTitle, category, jobDescription, skillsRequired, budget, deadline) VALUES (?, ?, ?, ?, ?, ?)");
        $success = $insertion->execute([$jobTitle, $category, $jobDescription, $skillsRequired, $budget, $deadline]);
        
        // Vérifier si l'insertion a réussi
        if ($success) {
            // Redirection vers la page de visualisation des informations avec les paramètres GET
            header("Location: categories/index.php?jobTitle=$jobTitle&category=$category&jobDescription=$jobDescription&skillsRequired=$skillsRequired&budget=$budget&deadline=$deadline");
            exit(); // Arrêter l'exécution du script après la redirection
        } else {
            echo '<script>alert("Erreur lors de l\'ajout des informations.")</script>';
        }
    } else {
        // La catégorie saisie n'existe pas dans la base de données
        echo '<script>alert("La catégorie saisie n\'existe pas.")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/about.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="icon" href="image/logo.png" type="image/x-icon">
        <script src="/javascript/javascript.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
        <title>Find Talent</title>
    </head>
    
    
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
                  <li class="item current"><a class="link" href="find_talent.php">FIND TALENT</a></li>
                  <li class="item"><a class="link" href="profil.php">PROFIL</a></li>
                 
                </ul>
              </div>
        </nav>
     
        <div class="container mt-5">
            <h2>Find Talent</h2>
            <p>Fill out the form below to submit your job posting and find the perfect talent for your project.</p>
            <form action="#" method="POST">
              <div class="form-group">
                <label for="jobTitle">Job Title:</label>
                <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
              </div>
              <div class="form-group">
                 <label for="category">Category:</label>
                 <input type="text" class="form-control" id="category" name="category" required>
               </div>
              <div class="form-group">
                <label for="jobDescription">Job Description:</label>
                <textarea class="form-control" id="jobDescription" name="jobDescription" rows="5" required></textarea>
              </div>
              <div class="form-group">
                <label for="skillsRequired">Skills Required:</label>
                <input type="text" class="form-control" id="skillsRequired" name="skillsRequired" required>
              </div>
              <div class="form-group">
                <label for="budget">Budget:</label>
                <input type="text" class="form-control" id="budget" name="budget" required>
              </div>
              <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" class="form-control" id="deadline" name="deadline" required>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>



          </div>

        <main>
  
            <div class="container main">
              
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
                      <a href="find_talent.html">FIND TALENT</a>
                      |
                      <a href="profil.php">PROFIL</a>

                    
                   
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