<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PROJECTS</title>
  <link rel="icon" href="../image/logo.png" type="image/x-icon">
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/courses.css">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
  <script src="/javascript/javascript.js"></script>

  
  </head>
  <body>
  
  <nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="imageBox">
      <div class="imageInn">
        <a href="index.html">
          <img src="../image/freelance.png" style="margin-left: 1rem; width: 100px; height: auto;" class="logo" alt="Logo">
        </a>
      </div>
    </div>
    
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#nav" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon bg-light"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-end" id="nav">
      <ul class="navbar-nav">
        <li class="item"><a class="link" href="../index.html">HOME</a></li>
        <li class="item current"><a class="link" href="categories/index.php">CATEGORIES</a></li>
        <li class="item"><a class="link" href="../freelancer.php">FREELANCER</a></li>
        <li class="item"><a class="link" href="../about.html">ABOUT</a></li>
        <li class="item"><a class="link" href="../contact.php">CONTACT</a></li>
        <li class="item"><a class="link" href="../signup.php">SIGN UP</a></li>
        <li class="item"><a class="link" href="../login.php">LOGIN</a></li>
      </ul>
    </div>
  </nav>
  
  <main>
  
      <div class="container">
        <img src="../image/group.png">
        <h2 class="top-trainer">Find the best freelance jobs </h2>
        <h4 class="quote-trainer"> "Make it real ".</h4>
      </div>
    </main>
 <section class="container2">
    <!-- Insérez ici le code HTML existant pour les candidats -->
    <!-- Je vais ajouter un bouton de contact pour chaque candidat -->
    <section class="trainer">
      <div class="container">
        <div class="blog-post">
          <div class="blog-post_img trainimg">
            <img src="../image/p.png" alt="">
          </div>
          <div class="blog-post_info">
            <div class="blog-post_date">
              
             <span><a href="https://www.facebook.com/ATTEducationMM"  id="trainer-icon"><i class="fa fa-facebook"></i></a>
               <a href="https://github.com/ATTEducation" id="trainer-icon"><i class="fa fa-github"></i></a>
               <a href="https://www.instagram.com/atteducationmm/" id="trainer-icon"><i class="fa fa-instagram" ></i></a></span>
            </div>
            <?php
// Connexion à la base de données
$bdd = new PDO('mysql:host=127.0.0.1;dbname=ranim', 'root', '');

// Requête pour sélectionner les emplois de la catégorie "Development & IT"
$sql = "SELECT * FROM job_info WHERE category = 'Development & IT'";
$result = $bdd->query($sql);

// Vérifier s'il y a des données à afficher
if ($result->rowCount() > 0) {
    // Début du tableau HTML
    echo "<table class='table'>";
    // En-têtes du tableau
    echo "<thead><tr><th>Titre du poste</th><th>Catégorie</th><th>Description</th><th>Compétences requises</th><th>Budget</th><th>Date limite</th></tr></thead>";
    // Corps du tableau
    echo "<tbody>";
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["jobTitle"]. "</td>";
        echo "<td>" . $row["category"]. "</td>";
        echo "<td>" . $row["jobDescription"]. "</td>";
        echo "<td>" . $row["skillsRequired"]. "</td>";
        echo "<td>" . $row["budget"]. "</td>";
        echo "<td>" . $row["deadline"]. "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    // Fin du tableau HTML
    echo "</table>";
} else {
    echo "<p class='text-muted'>Aucun emploi trouvé dans la catégorie 'Development & IT'</p>";
}
?>

               <div class="col-md-6 text-right">
               <button class="btn btn-apply ml-auto" onclick="showApplicationForm('Graphic_Design')">Apply for job</button>
             </div>
   <div id="applicationForm_Graphic_Design" style="display: none;">
     <div class="col-md-8">
       <h3>Your Application</h3>
       <p>
         Please fill out the form below to apply for the job.
       </p>
       <form class="form-light mt-20" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" placeholder="Your name" name="name" required>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email address" name="email" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" placeholder="Phone number" name="phone" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="resume_pdf">Resume (PDF)</label>
        <input type="file" class="form-control-file" id="resume_pdf" name="resume_pdf" required>
    </div>
    <button type="submit" class="btn btn-apply">Apply</button>
    <p><br/></p>
</form>

  </div>
</div>
            
      
  </div>
</div>
</section>

<?php
try {
    // Connexion à la base de données
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
    $phone = $_POST['phone'];

    // Gérer le fichier PDF uploadé
    $resumePdfName = $_FILES['resume_pdf']['name'];
    $resumePdfTmpName = $_FILES['resume_pdf']['tmp_name'];
    $resumePdfSize = $_FILES['resume_pdf']['size'];
    $resumePdfError = $_FILES['resume_pdf']['error'];

    // Vérifier si un fichier a été téléchargé
    if ($resumePdfError === 0) {
        // Définir le chemin de destination pour enregistrer le fichier
        $resumePdfDestination = 'C:\xampp\htdocs\uploads' . $resumePdfName;

        // Déplacer le fichier téléchargé vers le répertoire d'uploads
        if (move_uploaded_file($resumePdfTmpName, $resumePdfDestination)) {
            // Requête pour ajouter les données dans la table 'candidates' avec le nom du fichier PDF
            $sql = "INSERT INTO candidates (name, email, phone, resume_pdf) VALUES (:name, :email, :phone, :resumePdf)";
            $stmt = $bdd->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':resumePdf', $resumePdfDestination);

            // Exécuter la requête
            try {
                $stmt->execute();
                echo "Candidature soumise avec succès.";
            } catch (PDOException $e) {
                echo "Erreur lors de la soumission de la candidature : " . $e->getMessage();
            }
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement du fichier PDF.";
        }
    } else {
        echo "Erreur : " . $resumePdfError;
    }
}
?>          


 
       <script>
        function showApplicationForm(jobName) {
          var applicationForm = document.getElementById("applicationForm_" + jobName);
          if (applicationForm.style.display === "none") {
            applicationForm.style.display = "block";
          } else {
            applicationForm.style.display = "none";
          }
        }
        </script>



      <br>
</section>
       

      
    
</body>

    <footer class="footer-distributed">
            <div class="footer-left">
              <a href="index.html"><img src="../image/freelance.png" style="margin-left: 2rem; width: 150px; height: auto;"></a>
    
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