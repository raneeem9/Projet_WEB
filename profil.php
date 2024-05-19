<?php
try {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=client', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Addinformations'])) {
        $email = $_POST['email'];
        $birthdate = $_POST['birthdate'];
        $location = $_POST['location'];
        $freelancer_Since = $_POST['freelancer_Since'];
        $skills = $_POST['skills'];
        $experience = $_POST['experience'];

        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageDir = 'uploads/';
            $imageName = uniqid() . '_' . basename($_FILES['image']['name']);
            $imagePath = $imageDir . $imageName;

            // Vérifiez si le dossier de destination existe et créez-le s'il n'existe pas
            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0777, true);
            }

            // Déplacez le fichier téléchargé vers le dossier de destination
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $uploadError = $_FILES['image']['error'];
                echo '<script>alert("Erreur lors de l\'upload du fichier. Code: ' . $uploadError . '")</script>';
                exit;
            }
        } else {
            $uploadError = $_FILES['image']['error'];
            switch ($uploadError) {
                case UPLOAD_ERR_INI_SIZE:
                    $errorMessage = "Le fichier téléchargé dépasse la directive upload_max_filesize dans php.ini.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $errorMessage = "Le fichier téléchargé dépasse la directive MAX_FILE_SIZE spécifiée dans le formulaire HTML.";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $errorMessage = "Le fichier n'a été que partiellement téléchargé.";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $errorMessage = "Aucun fichier n'a été téléchargé.";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $errorMessage = "Un dossier temporaire est manquant.";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $errorMessage = "Échec de l'écriture du fichier sur le disque.";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $errorMessage = "Le téléchargement du fichier a été arrêté par une extension PHP.";
                    break;
                default:
                    $errorMessage = "Erreur inconnue lors de l'upload du fichier.";
                    break;
            }
            echo '<script>alert("' . $errorMessage . '")</script>';
            exit;
        }

        // Insérez les informations dans la base de données
        $insertinformations = $bdd->prepare("INSERT INTO freelancer (email, birthdate, location, freelancer_Since, skills, experience, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $success = $insertinformations->execute([$email, $birthdate, $location, $freelancer_Since, $skills, $experience, $imageName]);
        
        if ($success) {
            header("Location: display_information.php?email=$email&location=$location&birthdate=$birthdate&freelancer_Since=$freelancer_Since&skills=$skills&experience=$experience&image=$imagePath");
            exit();
        } else {
            echo '<script>alert("Erreur lors de l\'ajout des informations.")</script>';
        }
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
    <title>PROFIL</title>
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
            <li class="item current"><a class="link" href="profil.php">PROFIL</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <img src="image/per.png" class="img-fluid rounded-circle profile-image" alt="Profile Image">
        </div>
        <div class="col-md-8">
            <div class="overlay" id="Addinformations">
                <div class="login-popup" id="AddinformationsPopup">
                    <h2>Add informations</h2>
                    <button id="showFormButton">Add information</button>
                    <form id="informationForm" style="display: none;" method="POST" enctype="multipart/form-data">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>
                        <label for="birthdate">Birth date:</label>
                        <input type="date" id="birthdate" name="birthdate" required><br><br>
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" required><br><br>
                        <label for="freelancer_Since">Freelancer Since:</label>
                        <input type="text" id="freelancer_Since" name="freelancer_Since" required><br><br>
                        <label for="skills">Skills :</label>
                        <input type="text" id="skills" name="skills" required><br><br>
                        <label for="experience">Experience :</label>
                        <input type="text" id="experience" name="experience" required><br><br>
                        <label for="image">Your image :</label>
                        <input type="file" id="imageInput" accept="image/*" name="image" multiple required>
                        <div id="imagePreview"></div>
                        <button type="submit" id="submitBtn" name="Addinformations">Add informations</button>
                        <a id="inputclose" href="#" onclick="closeLogin()">Close</a>
                    </form>
                    <script>
                        document.getElementById('showFormButton').addEventListener('click', function() {
                            document.getElementById('informationForm').style.display = 'block';
                        });

                        document.getElementById('imageInput').addEventListener('change', function (e) {
                            var files = e.target.files;
                            var output = document.getElementById('imagePreview');
                            output.innerHTML = '';

                            for (var i = 0; i < files.length; i++) {
                                var file = files[i];
                                var imageType = /^image\//;

                                if (!imageType.test(file.type)) {
                                    continue;
                                }

                                var img = document.createElement("img");
                                img.classList.add('preview-image');
                                img.file = file;
                                img.style.maxWidth = '200px';
                                img.style.maxHeight = '200px';
                                output.appendChild(img);

                                var reader = new FileReader();
                                reader.onload = (function (aImg) {
                                    return function (e) {
                                        aImg.src = e.target.result;
                                    };
                                })(img);
                                reader.readAsDataURL(file);
                            }
                        });

                        function closeLogin() {
                            document.getElementById('informationForm').style.display = 'none';
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<main>
    <div class="container main"></div>
</main>

<footer class="footer-distributed">
    <div class="footer-left">
        <a href="index.html"><img src="image/freelance.png" style="margin-left: 2rem; width: 150px; height: auto;"></a>
        <p class="footer-links">
            <a href="index.html">HOME</a> |
            <a href="categories.php">CATEGORIES</a> |
            <a href="freelancer.php">FREELANCER</a> |
            <a href="about.html">ABOUT</a> |
            <a href="contact.php">CONTACT</a> |
            <a href="profil.php">PROFIL</a>
        </p>
        <p class="footer-company-name">Copyright © 2024 <strong>ToTheTopFREELANCER</strong> All rights reserved</p>
    </div>
    <div class="footer-center">
        <div class="center-link">
            <a href="#"><i class="fa fa-map-marker"></i></a>
            <p><span>Tunis</span> Tunisie</p>
        </div>
        <div class="center-link">
            <a href="tel:+95975125012"><i class="fa fa-phone"></i></a>
            <p>(+216) 9751252012</p>
        </div>
        <div class="center-link">
            <a href="mailto:tothetopfreelancer@gmail.com"><i class="fa fa-envelope"></i></a>
            <p><a href="mailto:tothetopfreelancer@gmail.com">tothetopfreelancer@gmail.com</a></p>
        </div>
    </div>
    <div class="footer-right">
        <p class="footer-company-about">
            <span>About the company</span>
            <strong>To The Top FREELANCER</strong> we are committed to providing top-notch customer service, striving for excellence in every aspect of our work. We are dedicated to exceeding expectations, continuously seeking innovation, and executing the most demanding projects with diligence and professionalism!
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