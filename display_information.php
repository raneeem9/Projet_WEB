<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=client', 'root', '');

// Vérifier si l'utilisateur est un freelancer
if ($_SESSION['user_type'] === 'freelancer') {
    try {
        $email = $_SESSION['user_email'];

        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateInformation'])) {
            // Récupérer les nouvelles informations du formulaire
            $newEmail = $_POST['email'];
            $birthdate = $_POST['birthdate'];
            $location = $_POST['location'];
            $freelancerSince = $_POST['freelancer_Since'];
            $skills = $_POST['skills'];
            $experience = $_POST['experience'];

            // Mettre à jour les informations dans la base de données
            $updateQuery = $bdd->prepare("UPDATE freelancer SET email = ?, birthdate = ?, location = ?, freelancer_Since = ?, skills = ?, experience = ? WHERE email = ?");
            $updateSuccess = $updateQuery->execute([$newEmail, $birthdate, $location, $freelancerSince, $skills, $experience, $email]);

            if ($updateSuccess) {
                // Mettre à jour l'email de session si l'email a été modifié
                $_SESSION['user_email'] = $newEmail;
                echo '<script>alert("Les informations ont été mises à jour avec succès.");</script>';
                // Recharger les informations actuelles
                $email = $newEmail;
            } else {
                echo '<script>alert("Erreur lors de la mise à jour des informations.");</script>';
            }
        }

        // Récupérer les informations actuelles du freelancer
        $query = $bdd->prepare("SELECT * FROM freelancer WHERE email = ?");
        $query->execute([$email]);
        $currentInfo = $query->fetch(PDO::FETCH_ASSOC);

        if (!$currentInfo) {
            echo "<p>Aucune information trouvée pour cet email.</p>";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas un freelancer
    header("Location: login.php");
    exit();
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
<style>
/* Style pour le bouton "Update information" */
#showFormButton {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px;
}

#showFormButton:hover {
    background-color: #0056b3;
}

/* Style pour le formulaire */
#informationForm {
    margin-top: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background: linear-gradient(to right top, #65dfc9, #d2b7e)
}

#informationForm label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

#informationForm input[type="text"],
#informationForm input[type="date"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}

#informationForm input[type="submit"] {
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #28a745;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#informationForm input[type="submit"]:hover {
    background: linear-gradient(to right top, #65dfc9, #d2b7e5);
}

#inputclose {
    display: inline-block;
    margin-top: 15px;
    font-size: 14px;
    color: #007bff;
    cursor: pointer;
    text-decoration: underline;
}

#inputclose:hover {
    color: #0056b3;
}




</style>
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
                <?php if ($currentInfo && $currentInfo['image']) { ?>
                    <img src="uploads/<?php echo urlencode($currentInfo['image']); ?>" class="img-fluid rounded-circle profile-image" alt="Profile Image">
                <?php } else { ?>
                    <p>No profile image found.</p>
                <?php } ?>
            </div>
            <div class="col-md-8">
                <?php if ($currentInfo) { ?>
                    <h2>Informations du Freelancer</h2>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($currentInfo['email']); ?></p>
                    <p><strong>Date de naissance:</strong> <?php echo htmlspecialchars($currentInfo['birthdate']); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($currentInfo['location']); ?></p>
                    <p><strong>Freelancer depuis:</strong> <?php echo htmlspecialchars($currentInfo['freelancer_Since']); ?></p>
                    <p><strong>Skills:</strong> <?php echo htmlspecialchars($currentInfo['skills']); ?></p>
                    <p><strong>Experience:</strong> <?php echo htmlspecialchars($currentInfo['experience']); ?></p>
                <?php } else { ?>
                    <p>Aucune information trouvée pour cet email.</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <button id="showFormButton">Update information</button>

    <form id="informationForm" style="display: none;" method="POST" enctype="multipart/form-data">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo isset($currentInfo['email']) ? htmlspecialchars($currentInfo['email']) : ''; ?>" required><br><br>
        <label for="birthdate">Date de naissance:</label>
        <input type="date" id="birthdate" name="birthdate" value="<?php echo isset($currentInfo['birthdate']) ? htmlspecialchars($currentInfo['birthdate']) : ''; ?>" required><br><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo isset($currentInfo['location']) ? htmlspecialchars($currentInfo['location']) : ''; ?>" required><br><br>
        <label for="freelancer_Since">Freelancer Depuis:</label>
        <input type="text" id="freelancer_Since" name="freelancer_Since" value="<?php echo isset($currentInfo['freelancer_Since']) ? htmlspecialchars($currentInfo['freelancer_Since']) : ''; ?>" required><br><br>
        <label for="skills">Skills:</label>
        <input type="text" id="skills" name="skills" value="<?php echo isset($currentInfo['skills']) ? htmlspecialchars($currentInfo['skills']) : ''; ?>" required><br><br>
        <label for="experience">Experience:</label>
        <input type="text" id="experience" name="experience" value="<?php echo isset($currentInfo['experience']) ? htmlspecialchars($currentInfo['experience']) : ''; ?>" required><br><br>
        <input type="submit" id="submitBtn" name="updateInformation" value="Update informations">
        <a id="inputclose" href="#" onclick="closeForm()">Close</a>
    </form>

    <script>
        document.getElementById('showFormButton').addEventListener('click', function() {
            document.getElementById('informationForm').style.display = 'block';
        });

        function closeForm() {
            document.getElementById('informationForm').style.display = 'none';
        }
    </script>

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

    <script src="javascript/javascript.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
