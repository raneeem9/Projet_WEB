<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=ranim','root','');

// Récupérer les informations actuelles de l'utilisateur depuis la base de données
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Récupérer l'email depuis le formulaire de mise à jour

    if (isset($_POST['updateInformation'])) {
        // Récupérez les nouvelles valeurs depuis le formulaire
        $newEmail = $_POST['email'];
        $newBirthdate = $_POST['birthdate'];
        $newLocation = $_POST['location'];
        $newFreelancerSince = $_POST['freelancer_Since'];
        $newSkills = $_POST['skills'];
        $newExperience = $_POST['experience'];

        // Mettez à jour les informations dans la base de données en fonction de l'email
        $updateInformation = $bdd->prepare("UPDATE informations SET email = :newEmail, birthdate = :newBirthdate, location = :newLocation, freelancer_Since = :newFreelancerSince, skills = :newSkills, experience = :newExperience WHERE email = :email");
        $success = $updateInformation->execute([
            'newEmail' => $newEmail,
            'newBirthdate' => $newBirthdate,
            'newLocation' => $newLocation,
            'newFreelancerSince' => $newFreelancerSince,
            'newSkills' => $newSkills,
            'newExperience' => $newExperience,
            'email' => $email
        ]);

        if ($success) {
            // Afficher les informations mises à jour
            echo '<script>alert("Informations mises à jour avec succès.")</script>';
            // Redirigez l'utilisateur vers une page de confirmation ou vers une autre page de son choix
            // header("Location: display_information.php");
            // exit();
        } else {
            echo '<script>alert("Erreur lors de la mise à jour des informations.")</script>';
        }
    }
}

// Récupérer les informations actuelles de l'utilisateur depuis la base de données en fonction de l'email
if (isset($_GET['email'])) {
    $email = $_GET['email']; // Récupérer l'email depuis la requête GET
    $currentInformation = $bdd->prepare("SELECT * FROM informations WHERE email = :email");
    $currentInformation->execute(['email' => $email]);
    $currentInfo = $currentInformation->fetch(PDO::FETCH_ASSOC);
    
    // Récupérer l'image
    $imageQuery = $bdd->prepare("SELECT image FROM images WHERE email = :email ORDER BY id DESC LIMIT 1");
    $imageQuery->execute(['email' => $email]);
    $imageResult = $imageQuery->fetch(PDO::FETCH_ASSOC);
    $imageData = $imageResult ? $imageResult['image'] : null;
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
        <title>PROFIL</title>
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
                  <li class="item current"><a class="link" href="profil.php">PROFIL</a></li>
                 
                </ul>
              </div>
        </nav>
      
      

        <div class="container mt-5">
            <div class="row">
            <div class="col-md-4">
            <!-- Image de profil -->
            <div class="col-md-4">
            <img src="<?php echo isset($currentInfo['image']) ? htmlspecialchars($currentInfo['image']) : ''; ?>" class="img-fluid rounded-circle profile-image" alt="Profile Image">
</div>
</div>

<div class="col-md-8">
    <h2>Informations saisies :</h2>
    <p><strong>Email:</strong> <?php echo isset($currentInfo['email']) ? $currentInfo['email'] : ''; ?></p>
    <p><strong>Location:</strong> <?php echo isset($currentInfo['location']) ? $currentInfo['location'] : ''; ?></p>
    <p><strong>Birthdate:</strong> <?php echo isset($currentInfo['birthdate']) ? $currentInfo['birthdate'] : ''; ?></p>
    <p><strong>Freelancer Since:</strong> <?php echo isset($currentInfo['freelancer_Since']) ? $currentInfo['freelancer_Since'] : ''; ?></p>
    <p><strong>Skills:</strong> <?php echo isset($currentInfo['skills']) ? $currentInfo['skills'] : ''; ?></p>
    <p><strong>Experience:</strong> <?php echo isset($currentInfo['experience']) ? $currentInfo['experience'] : ''; ?></p>
    <!-- Ajouter d'autres champs pour afficher les autres informations de l'utilisateur -->
</div>


<button id="showFormButton">Update information</button>

<form id="informationForm" style="display: none;" method="POST" enctype="multipart/form-data">
    <!-- Afficher les informations actuelles de l'utilisateur dans les champs du formulaire -->
    <label for="email">Email:</label>
    <input type="text" id="email" name="email" value="<?php echo isset($currentInfo['email']) ? $currentInfo['email'] : ''; ?>" required><br><br>
    <label for="birthdate">Birth date:</label>
    <input type="date" id="birthdate" name="birthdate" value="<?php echo isset($currentInfo['birthdate']) ? $currentInfo['birthdate'] : ''; ?>" required><br><br>
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" value="<?php echo isset($currentInfo['location']) ? $currentInfo['location'] : ''; ?>" required><br><br>
    <label for="freelancer_Since">Freelancer Since:</label>
    <input type="text" id="freelancer_Since" name="freelancer_Since" value="<?php echo isset($currentInfo['freelancer_Since']) ? $currentInfo['freelancer_Since'] : ''; ?>" required><br><br>
    <label for="skills">Skills:</label>
    <input type="text" id="skills" name="skills" value="<?php echo isset($currentInfo['skills']) ? $currentInfo['skills'] : ''; ?>" required><br><br>
    <label for="experience">Experience:</label>
    <input type="text" id="experience" name="experience" value="<?php echo isset($currentInfo['experience']) ? $currentInfo['experience'] : ''; ?>" required><br><br>
    <!-- Ajouter d'autres champs pour afficher les autres informations actuelles de l'utilisateur -->

    <input type="submit" id="submitBtn" name="updateInformation" value="Update informations">
    <a id="inputclose" href="#" onclick="closeLogin()">Close</a>
</form>

<script>
    document.getElementById('showFormButton').addEventListener('click', function() {
        document.getElementById('informationForm').style.display = 'block';
    });

    // Fonction pour fermer le popup
    function closeLogin() {
        document.getElementById('informationForm').style.display = 'none';
    }
</script>

        
    </div>
</div>



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